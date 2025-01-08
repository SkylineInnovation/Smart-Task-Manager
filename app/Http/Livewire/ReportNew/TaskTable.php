<?php

namespace App\Http\Livewire\ReportNew;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class TaskTable extends Component

{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public $tasks;


    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
       
        return view('livewire.report-new.task-table');
    }
}
