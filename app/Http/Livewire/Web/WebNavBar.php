<?php

namespace App\Http\Livewire\Web;

use App\Models\User;
use Livewire\Component;

class WebNavBar extends Component
{
    public $users = [];
    public $auth_user;

    public function mount()
    {
        $this->auth_user = auth()->user();
        $this->users = User::whereRoleIs('manager')->get();
    }

    public function render()
    {
        return view('livewire.web.web-nav-bar');
    }
}
