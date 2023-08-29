<?php

namespace App\Http\Controllers;

use App\Exports\ExportUser;
use App\Imports\ImportUser;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function importUsers(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);
        Excel::import(new ImportUser, $request->file('file')->store('files'));

        return redirect()->back();
    }

    public function exportUsers(Request $request)
    {
        return Excel::download(new ExportUser, 'export.xlsx');
    }
}
