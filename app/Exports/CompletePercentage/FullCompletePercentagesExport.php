<?php

namespace App\Exports\CompletePercentage;

use App\Models\CompletePercentage;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FullCompletePercentagesExport implements FromView
{
    private $completepercentages = [];

    public $by_date;
    public $from_date;
    public $to_date;

    public function __construct($by_date = null, $from_date = null, $to_date = null)
    {
        $this->by_date = $by_date ?? 'created_at';
        $this->from_date = $from_date ?? date('Y-m-d', strtotime("-150 days"));
        $this->to_date = $to_date ?? date('Y-m-d');

        $this->completepercentages = CompletePercentage::whereBetween($this->by_date, [$this->from_date . ' 00:00:00', $this->to_date . ' 23:59:59']);

        $this->completepercentages = $this->completepercentages->orderBy('id', 'asc')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('export.CompletePercentage.completepercentage-export', [
            'completepercentages' => $this->completepercentages,
            'number' => 0,
        ]);
    }
}
