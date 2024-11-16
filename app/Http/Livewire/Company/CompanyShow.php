<?php

namespace App\Http\Livewire\Company;

use App\Http\Controllers\HomeController;
use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\WithFileUploads;

class CompanyShow extends Component
{
    use WithFileUploads;

    public Company $company;

    public $technical_directors = [];
    public $financial_directors = [];

    public $name, $address, $logo,
        $phone, $number, $fax,
        $email, $website,
        $commercial_register,
        $technical_director_id, $financial_director_id;


    public $by, $url;
    public function mount(Company $company)
    {
        $this->url = Route::current()->getName();

        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->company = $company;

        $this->technical_directors = \App\Models\User::whereRoleIs('owner')->orderBy('first_name')->get();

        $this->financial_directors = \App\Models\User::whereRoleIs('owner')->orderBy('first_name')->get();

        $this->name = $company->name;
        $this->address = $company->address;
        $this->logo = $company->logo;
        $this->phone = $company->phone;
        $this->number = $company->number;
        $this->fax = $company->fax;
        $this->email = $company->email;
        $this->website = $company->website;
        $this->commercial_register = $company->commercial_register;
        $this->technical_director_id = $company->technical_director_id;
        $this->financial_director_id = $company->financial_director_id;
    }

    public function rules()
    {
        return [
            // 'patient_id' => "required|unique:patient_studies,patient_id,$this->patientstudy_id,id,study_id,$this->study_id,deleted_at,NULL",
            // 'slug' => $this-slug,

            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'number' => 'required',
            'fax' => 'required',
            'email' => 'required',
            'website' => 'required',
            'commercial_register' => 'required',
            'technical_director_id' => 'required',
            'financial_director_id' => 'required',
            // 'logo' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $validatedData = $this->validate();


        $this->company->update([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'number' => $this->number,
            'fax' => $this->fax,
            'email' => $this->email,
            'website' => $this->website,
            'commercial_register' => $this->commercial_register,
            'technical_director_id' => $this->technical_director_id,
            'financial_director_id' => $this->financial_director_id,
            'logo' => $this->logo != null ? HomeController::saveImageWeb($this->logo, 'compant') : $this->company->logo,
        ]);


        session()->flash('message', __('global.updated-successfully'));
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.updated-successfully')]); // show toster message
    }

    public function render()
    {
        return view('livewire.company.company-show');
    }
}
