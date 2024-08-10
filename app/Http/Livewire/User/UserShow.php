<?php

namespace App\Http\Livewire\User;

use App\Models\User;
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
    }


    public function render()
    {
        return view('livewire.user.user-show');
    }
}
