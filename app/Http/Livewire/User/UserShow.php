<?php

namespace App\Http\Livewire\User;

use App\Models\Discount;
use App\Models\ExtraTime;
use App\Models\Leave;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class UserShow extends Component
{
    public User $user;

    public $url;
    public function mount($user)
    {
        $this->url = Route::current()->getName();
        $this->user = $user;

        $this->from_date = date('Y-m-d', strtotime("-7 days"));
        $this->to_date = date('Y-m-d', strtotime("0 days"));

        $this->setData();
    }

    public $from_date, $to_date;


    public function clear()
    {
        $this->from_date = date('Y-m-d', strtotime("-7 days"));
        $this->to_date = date('Y-m-d', strtotime("0 days"));

        $this->setData();
    }

    public function updatedFromDate()
    {
        $this->setData();
    }

    public function updatedToDate()
    {
        $this->setData();
    }

    public $listOfDates;
    // 
    public $totalTask, $completedTask, $autoFinishedTask;
    public $totalTaskSum, $completedTaskSum, $autoFinishedTaskSum;

    // 
    public $totalExtratime, $totalLeave;
    // 
    public $totalTaskWorkSecs, $totalExtraTimeWorkSecs, $totalLeaveWorkSecs;
    public $totalTaskWork, $totalExtraTimeWork, $totalLeaveWork;
    // 
    public $totalDiscount, $totalDiscountAmount;

    public function setData()
    {
        $dateRange = CarbonPeriod::create($this->from_date, $this->to_date);

        $this->listOfDates = [];
        // 
        $this->totalTask = [];
        $this->completedTask = [];
        $this->autoFinishedTask = [];

        $this->totalTaskSum = 0;
        $this->completedTaskSum = 0;
        $this->autoFinishedTaskSum = 0;
        // 
        $this->totalExtratime = [];
        $this->totalLeave = [];

        $this->totalWorkSecs = 0;
        $this->totalExtraTimeWorkSecs = 0;
        $this->totalLeaveWorkSecs = 0;
        // 
        $this->totalDiscount = [];
        $this->totalDiscountAmount = 0;

        foreach ($dateRange as $date)
            $this->listOfDates[] = $date->format('Y-m-d');

        // $this->listOfDates[] = date('Y-m-d', strtotime($date . ' +1 days'));


        for ($i = 0; $i < count($this->listOfDates); $i++) {
            $tasks = Task::whereNullOrEmptyOrZero('main_task_id')
                ->whereNotIn('status', ['pending',])
                ->whereHas('employees', function ($q) {
                    $q->where('user_id', $this->user->id);
                })->where('created_at', 'like', '%' . $this->listOfDates[$i] . '%')->get();

            $this->totalTask[] = $tasks->count();
            $this->completedTask[] = $tasks->where('status', 'manual-finished')->count();
            $this->autoFinishedTask[] = $tasks->where('status', 'auto-finished')->count();

            $this->totalTaskSum += $tasks->count();
            $this->completedTaskSum += $tasks->where('status', 'manual-finished')->count();
            $this->autoFinishedTaskSum += $tasks->where('status', 'auto-finished')->count();

            foreach ($tasks as $task)
                $this->totalTaskWorkSecs += $task->duration_in_sec;


            // 
            $extratimes = ExtraTime::where('user_id', $this->user->id)
                ->where('created_at', 'like', '%' . $this->listOfDates[$i] . '%')->get();

            foreach ($extratimes as $extratime)
                $this->totalExtraTimeWorkSecs += $extratime->duration_in_sec;


            $this->totalExtratime[] = $extratimes->count();

            // 
            $leaves = Leave::where('user_id', $this->user->id)
                ->where('created_at', 'like', '%' . $this->listOfDates[$i] . '%')->get();

            foreach ($leaves as $leave)
                $this->totalLeaveWorkSecs += $leave->duration_in_sec;

            $this->totalLeave[] = $leaves->count();

            // 
            $discounts = Discount::where('user_id', $this->user->id)
                ->where('created_at', 'like', '%' . $this->listOfDates[$i] . '%')->get();

            foreach ($discounts as $discount) {
                $this->totalDiscountAmount += $discount->amount;
            }

            $this->totalDiscount[] = $discounts->count();
        }

        $this->calTaskWork();
        $this->calExtraTimeWork();
        $this->calLeaveWork();

        $data = [
            $this->listOfDates,
            // 
            $this->totalTask,
            $this->completedTask,
            $this->autoFinishedTask,
            // 
            $this->totalExtratime,
            $this->totalLeave,

            // $this->totalTaskSum,
            // $this->completedTaskSum,
            // $this->autoFinishedTaskSum,

            $this->totalTaskSum > 0 ? round($this->autoFinishedTaskSum / $this->totalTaskSum, 2) * 100 : 0,
            $this->totalTaskSum > 0 ? round($this->completedTaskSum / $this->totalTaskSum, 2) * 100 : 0,
        ];

        $this->emit('close-model', $data);
    }

    public function calTaskWork()
    {
        // $totalSeconds = $this->the_duration_in_sec();
        // Convert seconds to hours and minutes
        $hours = intval($this->totalTaskWorkSecs / 3600);
        $minutes = intval(($this->totalTaskWorkSecs % 3600) / 60);
        // 
        $hours_string = $hours > 9 ? $hours : '0' . $hours;
        $minutes_string = $minutes > 9 ? $minutes : '0' . $minutes;
        // Format the output
        $this->totalTaskWork = $hours_string . ' Hours, ' . $minutes_string . ':00 Minutes';
    }

    public function calExtraTimeWork()
    {
        // $totalSeconds = $this->the_duration_in_sec();
        // Convert seconds to hours and minutes
        $hours = intval($this->totalExtraTimeWorkSecs / 3600);
        $minutes = intval(($this->totalExtraTimeWorkSecs % 3600) / 60);
        // 
        $hours_string = $hours > 9 ? $hours : '0' . $hours;
        $minutes_string = $minutes > 9 ? $minutes : '0' . $minutes;
        // Format the output
        $this->totalExtraTimeWork = $hours_string . ' Hours, ' . $minutes_string . ':00 Minutes';
    }

    public function calLeaveWork()
    {
        // $totalSeconds = $this->the_duration_in_sec();
        // Convert seconds to hours and minutes
        $hours = intval($this->totalLeaveWorkSecs / 3600);
        $minutes = intval(($this->totalLeaveWorkSecs % 3600) / 60);
        // 
        $hours_string = $hours > 9 ? $hours : '0' . $hours;
        $minutes_string = $minutes > 9 ? $minutes : '0' . $minutes;
        // Format the output
        $this->totalLeaveWork = $hours_string . ' Hours, ' . $minutes_string . ':00 Minutes';
    }

    public function render()
    {
        return view('livewire.user.user-show');
    }
}
