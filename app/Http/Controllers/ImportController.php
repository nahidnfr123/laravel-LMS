<?php

namespace App\Http\Controllers;

use App\Imports\McqsImport;
use App\Imports\UserImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function user(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'batch_id' => 'required',
            'file' => 'required|file|mimes:ods,xls,xlsx',
        ]);
        $file = $request->file;
        if ($file->extension() === 'ods') {
            (new UserImport($request->batch_id))->import($file, null, \Maatwebsite\Excel\Excel::ODS);
        } else {
            (new UserImport($request->batch_id))->import($file, null, \Maatwebsite\Excel\Excel::XLSX);
        }
        return redirect()->back();
    }

}
