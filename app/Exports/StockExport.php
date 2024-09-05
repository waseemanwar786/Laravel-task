<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class StockExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Get the data for the export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Stock::select('variant', DB::raw('GROUP_CONCAT(id SEPARATOR "|") as stock_ids'))
                    ->groupBy('variant')
                    ->get();
    }

    /**
     * Define the headings for the columns.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'SKU',
            'Stock IDs'
        ];
    }

    /**
     * Map the data to be written to the XLSX file.
     *
     * @param mixed $stock
     * @return array
     */
    public function map($stock): array
    {
        return [
            $stock->variant,
            $stock->stock_ids
        ];
    }
}
