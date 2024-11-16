<?php

namespace App\Http\Livewire\Company;

use App\Http\Controllers\HomeController;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CompanyIndex extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 25;
    public $search = '';
    public $orderBy = 'id';
    public $orderWay = 'desc';
    public $showColumn;

    public $all;
    public $fromDate = null;
    public $toDate = null;
    public $byDate = 'created_at';

    public $selectedCompanies = [];

    public Company $company;
    private $companies;
    public $user;


    public $technical_directors = [];

    public $financial_directors = [];



    public $filter_technical_directors_id = [];

    public $filter_financial_directors_id = [];



    public $admin_view_status = '', $by, $url;
    public function mount($admin_view_status = '')
    {
        $this->url = Route::current()->getName();
        $this->admin_view_status = $admin_view_status;
        $this->user = Auth::user();
        $this->by = session()->get('admin_user', $this->user);

        $this->company = new Company();

        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->toDate = date('Y-m-d');



        $this->technical_directors = \App\Models\User::whereRoleIs('owner')->orderBy('first_name')->get();

        $this->financial_directors = \App\Models\User::whereRoleIs('owner')->orderBy('first_name')->get();


        $this->showColumn = collect([
            'id' => false,
            'slug' => false,


            'name' => true,
            'address' => true,
            'phone' => true,
            'number' => true,
            'fax' => true,
            'email' => true,
            'website' => true,
            'commercial_register' => true,
            'technical_director_id' => true,
            'financial_director_id' => true,
            'logo' => true,

            // 'status' => false,
            'date' => true,
            'time' => false,
        ]);
    }

    public $slug;
    public $company_id, $name, $address, $phone, $number, $fax, $email, $website, $commercial_register, $technical_director_id, $financial_director_id, $logo;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->slug = '';

        $this->name = '';
        $this->address = '';
        $this->phone = '';
        $this->number = '';
        $this->fax = '';
        $this->email = '';
        $this->website = '';
        $this->commercial_register = '';
        $this->technical_director_id = null;
        $this->financial_director_id = null;
        $this->logo = '';
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
            'logo' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();

        Company::create([
            'add_by' => $this->by->id,
            'slug' => $this->slug,

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
            'logo' => HomeController::saveImageWeb($this->logo, 'company'),
        ]);

        session()->flash('message', __('global.created-successfully'));
        $this->resetInputFields();
        $this->emit('close-model'); // Close model to using to jquery
        $this->emit('show-message', ['message' => __('global.created-successfully')]); // show toster message
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $company = Company::find($id);
        $this->company = $company;
        $this->company_id = $id;
        $this->slug = $company->slug;


        $this->name = $company->name;
        $this->address = $company->address;
        $this->phone = $company->phone;
        $this->number = $company->number;
        $this->fax = $company->fax;
        $this->email = $company->email;
        $this->website = $company->website;
        $this->commercial_register = $company->commercial_register;
        $this->technical_director_id = $company->technical_director_id;
        $this->financial_director_id = $company->financial_director_id;
        // $this->logo = $company->logo;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {

        if ($this->company_id) {
            $company = Company::find($this->company_id);
            $company->update([
                'slug' => $this->slug,

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
                // 'logo' => $this->logo,
                'logo' => $this->logo != null ? HomeController::saveImageWeb($this->logo, 'compant') : $this->company->logo,
            ]);

            $this->updateMode = false;
            session()->flash('message', __('global.updated-successfully'));
            $this->resetInputFields();
            $this->emit('close-model'); // Close model to using to jquery
            $this->emit('show-message', ['message' => __('global.updated-successfully')]); // show toster message
        }
    }

    public function delete($id)
    {
        if ($id) {
            $company = Company::find($id);

            $company->delete();

            session()->flash('message', __('global.deleted-successfully'));
            $this->emit('show-message', ['message' => __('global.deleted-successfully')]); // show toster message
        }
    }

    public function restore($id)
    {
        if ($id) {
            $company = Company::withTrashed()->find($id);

            $company->restore();

            session()->flash('message', __('global.recovered-successfully'));
            $this->emit('show-message', ['message' => __('global.recovered-successfully')]); // show toster message
        }
    }

    public function updatedFromDate($fromDate)
    {
        $this->all = false;
    }

    public function updatedToDate($toDate)
    {
        $this->all = false;
    }

    public function clearFilter()
    {
        $this->all = true;
        // $this->fromDate = date('Y-m-d', strtotime("-5 days"));
        $this->byDate = 'created_at';
        $this->fromDate = '';
        $this->toDate = date('Y-m-d');


        $this->filter_technical_directors_id = [];

        $this->filter_financial_directors_id = [];
    }


    public $select_technical_director;
    public function updatedSelectTechnical_director($val)
    {
        $this->filter_technical_directors_id[] = $val;
    }


    public $select_financial_director;
    public function updatedSelectFinancial_director($val)
    {
        $this->filter_financial_directors_id[] = $val;
    }




    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->emit('gotoTop');
    }

    public function nextPage()
    {
        $this->setPage($this->page + 1);
        $this->emit('gotoTop');
    }

    public function previousPage()
    {
        $this->setPage(max($this->page - 1, 1));
        $this->emit('gotoTop');
    }

    public function render()
    {
        $companies = Company::livewireSearch($this->search);

        if ($this->all == false)
            $companies = $companies->whereBetween($this->byDate, [$this->fromDate . ' 00:00:00', $this->toDate . ' 23:59:59']);



        if ($this->filter_technical_directors_id)
            $companies = $companies->whereIn('technical_director_id', $this->filter_technical_directors_id);

        if ($this->filter_financial_directors_id)
            $companies = $companies->whereIn('financial_director_id', $this->filter_financial_directors_id);


        if ($this->admin_view_status == 'deleted')
            $companies = $companies->onlyTrashed();


        $companies = $companies->orderBy($this->orderBy, $this->orderWay)
            ->paginate($this->perPage);

        return view('livewire.company.company-index', compact('companies'));
    }
}
