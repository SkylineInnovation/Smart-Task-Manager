<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user.user-home');
    }

    public function show(User $user)
    {
        return view('pages.user.user-show', compact('user'));
    }
}
