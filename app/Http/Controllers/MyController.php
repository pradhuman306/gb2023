<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;


class MyController extends Controller
{
    public function importExportView()
    {
       return view('import');
    }
    public function export() 
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }
    public function import() 
    {
        Excel::import(new StudentsImport,request()->file('file'));
           
        return back();
    }
}
