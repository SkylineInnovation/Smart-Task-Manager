<?php

namespace App\Exports\OtpSendCode;

use App\Models\OtpSendCode;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FullOtpSendCodesExport implements FromView
{
    private $otpsendcodes = [];

    public $by_date;
    public $from_date;
    public $to_date;

    public function __construct($by_date = null, $from_date = null, $to_date = null)
    {
        $this->by_date = $by_date ?? 'created_at';
        $this->from_date = $from_date ?? date('Y-m-d', strtotime("-150 days"));
        $this->to_date = $to_date ?? date('Y-m-d');

        $this->otpsendcodes = OtpSendCode::whereBetween($this->by_date, [$this->from_date . ' 00:00:00', $this->to_date . ' 23:59:59']);

        $this->otpsendcodes = $this->otpsendcodes->orderBy('id', 'asc')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('export.OtpSendCode.otpsendcode-export', [
            'otpsendcodes' => $this->otpsendcodes,
            'number' => 0,
        ]);
    }
}
