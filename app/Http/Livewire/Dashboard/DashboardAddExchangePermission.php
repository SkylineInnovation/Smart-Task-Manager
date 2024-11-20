<?php

namespace App\Http\Livewire\Dashboard;

use App\Http\Controllers\HomeController;
use App\Models\ExchangePermission;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class DashboardAddExchangePermission extends Component
{
    use WithFileUploads;

    public $content, $amount, $attachment, $request_date,
        // $financial_director_id, $financial_director_response, $financial_director_time,
        // $technical_director_id, $technical_director_response, $technical_director_time,
        $status;


    public function mount()
    {
        $this->get_create_date();
    }

    public function get_create_date()
    {
        // $this->managers = \App\Models\User::whereRoleIs('owner')->orWhereRoleIs('manager')->orderBy('first_name')->get();
        $this->content = '';
        $this->amount = 0;
        $this->attachment = null;
    }

    private function resetInputFields()
    {
        $this->content = '';
        $this->amount = 0;
        $this->attachment = null;
    }


    public function rules()
    {
        return [
            'content' => 'required',
            'amount' => 'required',
            'attachment' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        ExchangePermission::create([
            'add_by' => Auth::user()->id,
            'user_id' => Auth::user()->id,

            'content' => $this->content,
            'amount' => $this->amount,
            'attachment' => HomeController::saveImageWeb($this->attachment, 'exchange_permission'),

            'request_date' => date('Y-m-d\TH:i'),

            'status' => 'pending',
        ]);

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-add-exchange-permission');
    }
}
