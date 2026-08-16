<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SlugService
{
    /**
     * Generate a unique slug for the given table/column, appending a numeric
     * suffix when the base slug already exists. When $ignoreId is provided
     * (update scenario) rows with that id are excluded from the check.
     */
    public function make(string $value, string $table, ?int $ignoreId = null, string $column = 'slug'): string
    {
        $base = Str::slug($value);
        $slug = $base;
        $i = 2;

        while ($this->exists($slug, $table, $column, $ignoreId)) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }

    protected function exists(string $slug, string $table, string $column, ?int $ignoreId): bool
    {
        $query = DB::table($table)->where($column, $slug);

        if ($ignoreId !== null) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }
}
