<?php

namespace App\Http\Controllers;

// use App\Models\OtpSendCode;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OtpSendCode\FullOtpSendCodesExport;
use App\Imports\OtpSendCode\FullOtpSendCodesImport;


class OtpSendCodeController extends Controller
{
    public function livewireIndex()
    {
        $admin_view_status = 'all';
        return view('pages.crud.otpsendcode.otpsendcode-home', compact('admin_view_status'));
    }

    public function livewireDeletedIndex()
    {
        $admin_view_status = 'deleted';
        return view('pages.crud.otpsendcode.otpsendcode-home', compact('admin_view_status'));
    }

    public function exportFullData(Request $request)
    {
        // $extension = '.pdf';
        // if (auth()->user()->hasRole('owner'))
            $extension = '.xlsx';

        $name = 'otpsendcodes-' . date('Y-m-d') . $extension;
        $by_date = $request->input('by_date', 'created_at');
        $from_date = $request->input('from_date', date('Y-m-d', strtotime("-150 days")));
        $to_date = $request->input('to_date', date('Y-m-d'));

        return Excel::download(new FullOtpSendCodesExport($by_date, $from_date, $to_date), $name);
    }

    public function importData(Request $request)
    {
        $extension = $request->excel_file->extension();
        // Log::alert("extension -> $extension");

        if ($extension != 'csv' && $extension != 'txt')
            return Redirect::back()->with('error', 'Error: Please import an excel file with the extension "csv utf-8 (comma delimited) (*.csv)"');

        $import_type = $request->input('import_type', 'stander');

        if ($import_type == 'stander'){
            Excel::import(new FullOtpSendCodesImport, $request->excel_file);
        }

        return Redirect::back()->with('success', 'Data Imported Successfully');
    }
}
