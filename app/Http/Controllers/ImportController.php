<?php

namespace App\Http\Controllers;

use App\Imports\AttendanceImport;
use App\Imports\MarkImport;
use App\Imports\McqsImport;
use App\Imports\UserImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function mark(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'batch_id' => 'required',
            'total_mark' => 'required',
            'topic_id' => 'required',
            'file' => 'required|file|mimes:ods,xls,xlsx',
        ]);
        $file = $request->file;
        if ($file->extension() === 'ods') {
            (new MarkImport($request->topic_id, $request->total_mark))
                ->import($file, null, \Maatwebsite\Excel\Excel::ODS);
        } else {
            (new MarkImport($request->topic_id, $request->total_mark))
                ->import($file, null, \Maatwebsite\Excel\Excel::XLSX);
        }
        return redirect()->back();
    }

    public function attendance(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'batch_id' => 'required',
            'total_classes' => 'required',
            'topic_id' => 'required',
            'file' => 'required|file|mimes:ods,xls,xlsx',
        ]);
        $file = $request->file;
        if ($file->extension() === 'ods') {
            (new AttendanceImport($request->topic_id, $request->total_classes))
                ->import($file, null, \Maatwebsite\Excel\Excel::ODS);
        } else {
            (new AttendanceImport($request->topic_id, $request->total_classes))
                ->import($file, null, \Maatwebsite\Excel\Excel::XLSX);
        }
        return redirect()->back();
    }

}
