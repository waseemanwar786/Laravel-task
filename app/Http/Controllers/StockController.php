<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\StockExport;
use App\Imports\StockImport;
use Maatwebsite\Excel\Facades\Excel;

class StockController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv',
        ]);
       Excel::import(new StockImport, $request->file('file'));  //import the xls,xlsx or csv file
        return back()->with('success', 'Excel file imported successfully!');

    }
    public function download(){
        return Excel::download(new StockExport, 'stock_data.xlsx');
}
}
