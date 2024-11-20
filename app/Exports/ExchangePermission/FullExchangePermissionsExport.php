<?php

namespace App\Exports\ExchangePermission;

use App\Models\ExchangePermission;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FullExchangePermissionsExport implements FromView
{
    private $exchangepermissions;

    public $by_date;
    public $from_date;
    public $to_date;

    public function __construct($by_date = null, $from_date = null, $to_date = null)
    {
        $this->by_date = $by_date ?? 'created_at';
        $this->from_date = $from_date ?? date('Y-m-d', strtotime("-150 days"));
        $this->to_date = $to_date ?? date('Y-m-d');

        $this->exchangepermissions = ExchangePermission::whereBetween($this->by_date, [$this->from_date . ' 00:00:00', $this->to_date . ' 23:59:59']);

        $this->exchangepermissions = $this->exchangepermissions->orderBy('id', 'asc')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('export.Exchangepermission.exchangepermission-export', [
            'exchangepermissions' => $this->exchangepermissions,
            'number' => 0,
        ]);
    }
}
