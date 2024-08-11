<?php

namespace App\Exports\Attachment;

use App\Models\Attachment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FullAttachmentsExport implements FromView
{
    private $attachments;

    public $by_date;
    public $from_date;
    public $to_date;

    public function __construct($by_date = null, $from_date = null, $to_date = null)
    {
        $this->by_date = $by_date ?? 'created_at';
        $this->from_date = $from_date ?? date('Y-m-d', strtotime("-150 days"));
        $this->to_date = $to_date ?? date('Y-m-d');

        $this->attachments = Attachment::whereBetween($this->by_date, [$this->from_date . ' 00:00:00', $this->to_date . ' 23:59:59']);

        $this->attachments = $this->attachments->orderBy('id', 'asc')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('export.Attachment.attachment-export', [
            'attachments' => $this->attachments,
            'number' => 0,
        ]);
    }
}
