<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $path = $request->file('csv_file')->getRealPath();
        $file = fopen($path, 'r');
        $header = fgetcsv($file);

        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

            Stock::create([
                'variant' => $data['variant'],
                'stock' => $data['stock'],
            ]);
        }

        fclose($file);

        return back()->with('success', 'CSV data imported successfully.');
    }
    public function download(){
        // Fetch data from the database
    $data = DB::table('stocks')
    ->select('variant', DB::raw('GROUP_CONCAT(id SEPARATOR "|") as stock_ids'))
    ->groupBy('variant')
    ->get();
// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the headers
$sheet->setCellValue('A1', 'SKU');
$sheet->setCellValue('B1', 'Stock_Ids');

// Write the data
$rowNumber = 2; // Start from the second row because the first row is the header
foreach ($data as $row) {
    $sheet->setCellValue('A' . $rowNumber, $row->variant);
    $sheet->setCellValue('B' . $rowNumber, $row->stock_ids);
    $rowNumber++;

    }
    // Save the spreadsheet to a temporary file
    $filename = 'stock_data.xlsx';
    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);

    // Return the file as a download
    return Response::download($filename)->deleteFileAfterSend(true);
}
}
