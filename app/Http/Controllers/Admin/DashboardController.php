<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Traffic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.dashboard', $this->payload($request));
    }

    public function data(Request $request): JsonResponse
    {
        $data = $this->payload($request);

        $data['fromDate'] = $data['from']->locale('id')->isoFormat('D MMM YYYY');
        $data['toDate'] = $data['to']->locale('id')->isoFormat('D MMM YYYY');
        $data['fromDateInput'] = $data['from']->format('Y-m-d');
        $data['toDateInput'] = $data['to']->format('Y-m-d');

        return response()->json($data);
    }

    protected function payload(Request $request): array
    {
        $totalServicesActive = Service::where('status', true)->count();

        [$filter, $from, $to, $periodLabel] = $this->resolvePeriod($request);
        $periodLabelLower = mb_strtolower($periodLabel);

        $totalLeads = Customer::count();
        $totalVisitors = $this->countVisitors();

        $periodLeads = Customer::whereBetween('created_at', [$from, $to])->count();
        $periodTraffic = Traffic::where('is_lead', true)->whereBetween('created_at', [$from, $to])->count();
        $periodVisitors = $this->countVisitors($from, $to);

        $totalTraffic = Traffic::where('is_lead', true)->count();

        [$prevFrom, $prevTo] = $this->previousWindow($from, $to);
        $visitorChange = $this->percentChange($periodVisitors, $this->countVisitors($prevFrom, $prevTo));
        $trafficChange = $this->percentChange(
            $periodTraffic,
            Traffic::where('is_lead', true)->whereBetween('created_at', [$prevFrom, $prevTo])->count()
        );
        $leadChange = $this->percentChange(
            $periodLeads,
            Customer::whereBetween('created_at', [$prevFrom, $prevTo])->count()
        );

        [$leadChartCategories, $leadChartData, $trendStep] = $this->seriesBuckets(
            $from,
            $to,
            fn () => Customer::whereBetween('created_at', [$from, $to])
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as d, COUNT(*) as total")
                ->groupBy('d')
                ->pluck('total', 'd')
        );
        [, $trafficChartData] = $this->seriesBuckets(
            $from,
            $to,
            fn () => Traffic::where('is_lead', true)->whereBetween('created_at', [$from, $to])
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as d, COUNT(*) as total")
                ->groupBy('d')
                ->pluck('total', 'd')
        );
        [, $visitorChartData] = $this->seriesBuckets(
            $from,
            $to,
            fn () => \Illuminate\Support\Facades\DB::table('traffics')
                ->whereBetween('created_at', [$from, $to])
                ->whereNotNull('ip')
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as d, COUNT(DISTINCT ip) as total")
                ->groupBy('d')
                ->pluck('total', 'd')
        );

        $visitsBySumber = [];
        Traffic::where('is_lead', true)
            ->whereBetween('created_at', [$from, $to])
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->get()
            ->each(function ($row) use (&$visitsBySumber) {
                $label = $row->category && trim($row->category) !== '' ? $row->category : 'Tanpa Kategori';
                $visitsBySumber[$label] = (int) $row->total;
            });
        arsort($visitsBySumber);
        $visitsBySumberLabels = array_keys($visitsBySumber);

        $recentLeads = Customer::latest()
            ->take(10)
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'nama' => $c->nama,
                'no_hp' => $c->no_hp,
                'waktu' => $c->created_at->format('d/m/Y'),
                'sumber' => $c->sumber,
                'layanan' => $c->layanan,
                'item' => $c->item,
                'status' => $c->status,
                'counts' => $c->counts,
            ])
            ->all();

        $hasCustomRange = $request->filled('date_from') && $request->filled('date_to');

        return compact(
            'filter', 'from', 'to', 'periodLabel', 'periodLabelLower',
            'totalServicesActive',
            'totalLeads', 'totalTraffic', 'totalVisitors',
            'periodLeads', 'periodTraffic', 'periodVisitors',
            'visitorChange', 'trafficChange', 'leadChange',
            'leadChartCategories', 'leadChartData',
            'trafficChartData', 'visitorChartData', 'trendStep',
            'visitsBySumber', 'visitsBySumberLabels',
            'recentLeads',
            'hasCustomRange'
        );
    }

    protected function countVisitors(?Carbon $from = null, ?Carbon $to = null): int
    {
        $query = \Illuminate\Support\Facades\DB::table('traffics')
            ->whereNotNull('ip');

        if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }

        return (int) $query->selectRaw('COUNT(DISTINCT ip, DATE(created_at)) as total')->value('total');
    }

    protected function resolvePeriod(Request $request): array
    {
        $filter = $request->input('filter');

        if (!in_array($filter, ['harian', 'mingguan', 'bulanan', 'tahunan'], true)) {
            $filter = $this->autoFilter();
        }

        $today = Carbon::today();

        if ($request->filled('date_from') && $request->filled('date_to')) {
            try {
                $from = Carbon::parse($request->date_from)->startOfDay();
                $to = Carbon::parse($request->date_to)->endOfDay();
            } catch (\Throwable $e) {
                $from = $today->copy();
                $to = $today->copy()->endOfDay();
            }

            if ($from->gt($to)) {
                [$from, $to] = [$to, $from];
            }

            $todayEnd = $today->copy()->endOfDay();
            if ($to->gt($todayEnd)) {
                $to = $todayEnd->copy();
            }
            if ($from->gt($to)) {
                $from = $to->copy();
            }

            return [$filter, $from, $to, 'Periode Ini'];
        }

        return match ($filter) {
            'harian' => [$filter, $today->copy(), $today->copy()->endOfDay(), 'Hari Ini'],
            'bulanan' => [$filter, $today->copy()->startOfMonth(), $today->copy()->endOfDay(), 'Bulan Ini'],
            'tahunan' => [$filter, $today->copy()->startOfYear(), $today->copy()->endOfDay(), 'Tahun Ini'],
            default => [$filter, $today->copy()->startOfWeek(Carbon::MONDAY), $today->copy()->endOfDay(), 'Minggu Ini'],
        };
    }

    protected function autoFilter(): string
    {
        $latest = Customer::latest('created_at')->value('created_at')
            ?? Traffic::latest('created_at')->value('created_at');

        if (!$latest) {
            return 'mingguan';
        }

        $date = Carbon::parse($latest);
        $today = Carbon::today();

        if ($date->isSameDay($today)) {
            return 'harian';
        }

        if ($date->gte($today->copy()->startOfWeek(Carbon::MONDAY))) {
            return 'mingguan';
        }

        if ($date->gte($today->copy()->startOfMonth())) {
            return 'bulanan';
        }

        return 'tahunan';
    }

    protected function previousWindow(Carbon $from, Carbon $to): array
    {
        $days = $from->startOfDay()->diffInDays($to->startOfDay()) + 1;

        $prevTo = $from->copy()->startOfDay()->subDay()->endOfDay();
        $prevFrom = $prevTo->copy()->subDays($days - 1)->startOfDay();

        return [$prevFrom, $prevTo];
    }

    protected function percentChange(int $current, int $previous): float
    {
        return $previous > 0
            ? round((($current - $previous) / $previous) * 100, 1)
            : ($current > 0 ? 100 : 0);
    }

    protected function seriesBuckets(Carbon $from, Carbon $to, callable $dailyCounts): array
    {
        $start = $from->copy()->startOfDay();
        $end = $to->copy()->startOfDay();

        $days = $start->diffInDays($end) + 1;
        $step = $days <= 31 ? 'day' : ($days <= 400 ? 'month' : 'year');

        $categories = [];
        $keys = [];

        $cursor = $start->copy();

        for ($i = 0; $i < 500; $i++) {
            if ($cursor->gt($end)) {
                break;
            }

            $bucketEnd = match ($step) {
                'day' => $cursor->copy()->endOfDay(),
                'month' => $cursor->copy()->endOfMonth(),
                default => $cursor->copy()->endOfYear(),
            };

            if ($bucketEnd->gt($end)) {
                $bucketEnd = $end->copy()->endOfDay();
            }

            $categories[] = $this->bucketLabel($cursor, $step);
            $keys[] = $this->bucketKey($cursor, $step);

            $cursor = $bucketEnd->copy()->addSecond()->startOfDay();
        }

        $daily = $dailyCounts();

        $data = array_map(function ($key) use ($daily, $step) {
            $total = 0;
            foreach ($daily as $d => $count) {
                if ($step === 'day') {
                    if ($d === $key) {
                        $total += (int) $count;
                    }
                } elseif (str_starts_with($d, $key)) {
                    $total += (int) $count;
                }
            }
            return $total;
        }, $keys);

        return [$categories, $data, $step];
    }

    protected function bucketKey(Carbon $date, string $step): string
    {
        return match ($step) {
            'day' => $date->format('Y-m-d'),
            'month' => $date->format('Y-m'),
            default => (string) $date->year,
        };
    }

    protected function bucketLabel(Carbon $date, string $step): string
    {
        return match ($step) {
            'day' => $date->locale('id')->isoFormat('D MMM'),
            'year' => (string) $date->year,
            default => $date->locale('id')->isoFormat('MMM Y'),
        };
    }
}
