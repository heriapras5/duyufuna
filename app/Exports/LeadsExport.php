<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LeadsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting, WithColumnWidths, WithEvents
{
    public function __construct(private Collection $leads)
    {
    }

    public function collection(): Collection
    {
        return $this->leads;
    }

    public function headings(): array
    {
        return ['No', 'Nama', 'No. Handphone', 'Sumber', 'Alamat', 'Status', 'Tanggal Rekam'];
    }

    public function map($lead): array
    {
        static $i = 0;
        $i++;

        return [
            $i,
            $lead->nama,
            $lead->no_hp,
            $lead->sumber ?? '-',
            $lead->alamat ?? '-',
            \App\Models\Customer::STATUSES[$lead->status] ?? ucfirst((string) $lead->status),
            $lead->created_at->format('d/m/Y'),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => '@',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 32,
            'C' => 20,
            'D' => 20,
            'E' => 55,
            'F' => 16,
            'G' => 20,
        ];
    }

    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '005C3B']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $rowCount = max($this->leads->count(), 1);
                $lastRow = $rowCount + 1;

                $sheet->freezePane('A2');
                $sheet->getRowDimension(1)->setRowHeight(26);

                for ($r = 2; $r <= $lastRow; $r++) {
                    $sheet->getRowDimension($r)->setRowHeight(22);
                }

                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'E5E7EB'],
                        ],
                    ],
                ];
                $sheet->getStyle('A1:G' . $lastRow)->applyFromArray($styleArray);

                $sheet->getStyle('B2:B' . $lastRow)
                    ->getAlignment()->setWrapText(true)
                    ->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle('E2:E' . $lastRow)
                    ->getAlignment()->setWrapText(true)
                    ->setVertical(Alignment::VERTICAL_TOP);

                $sheet->getStyle('A2:A' . $lastRow)
                    ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle('F2:G' . $lastRow)
                    ->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle('C2:C' . $lastRow)
                    ->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle('D2:D' . $lastRow)
                    ->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                $totalRow = $lastRow + 1;
                $sheet->setCellValue('A' . $totalRow, 'Total:');
                $sheet->setCellValue('B' . $totalRow, $this->leads->count() . ' lead');
                $sheet->getStyle('A' . $totalRow . ':B' . $totalRow)
                    ->getFont()->setBold(true)
                    ->getColor()->setRGB('005C3B');
                $sheet->getStyle('A' . $totalRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle('A' . $totalRow . ':B' . $totalRow)
                    ->getBorders()->getTop()->setBorderStyle(Border::BORDER_MEDIUM);
            },
        ];
    }
}