<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function switchLang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        return Redirect::back();
    }

    public function sidenavToggled()
    {
        if (session('sidenav-toggled') == 'big') {
            session()->put('sidenav-toggled', 'small');
        } else {
            session()->put('sidenav-toggled', 'big');
        }

        return;
    }

    public function home()
    {
        $listOfDates = [
            date('Y-m-d', strtotime("-7 days")),
            date('Y-m-d', strtotime("-6 days")),
            date('Y-m-d', strtotime("-5 days")),
            date('Y-m-d', strtotime("-4 days")),
            date('Y-m-d', strtotime("-3 days")),
            date('Y-m-d', strtotime("-2 days")),
            date('Y-m-d', strtotime("-1 days")),
            date('Y-m-d', strtotime("0 days")),
        ];

        $userList = [];

        for ($i = 0; $i < count($listOfDates); $i++) {
            $userList[] = User::where('created_at', 'like', '%' . $listOfDates[$i] . '%')->count();
        }

        $listOfDates[] = date('Y-m-d', strtotime("+1 days"));
        $listOfDates[] = date('Y-m-d', strtotime("+2 days"));

        return view('home', compact('listOfDates', 'userList'));
    }

    public function editProfile()
    {
        $user = Auth::user();

        return view('stander.user.edit-profile', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            // 'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        // $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');

        $user = $request->user();

        // if (!Hash::check($current_password, $user->password))
        //     return back()->withInput()->with('error', __('global.Current Password Not Correct'));

        if ($new_password != $confirm_password)
            return back()->withInput()->with('error', __('global.Password Not Match'));


        $user->update(['password' => Hash::make($new_password)]);

        return back()->with('success', __('global.Password Changed'));
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'birth_day' => 'required',
        ]);

        $user->update([
            'first_name' => $request->input('first_name', $user->first_name),
            'last_name' => $request->input('last_name', $user->last_name),
            'user_name' => $request->input('user_name', $user->user_name),
            'email' => $request->input('email', $user->email),
            'phone' => $request->input('phone', $user->phone),
            'gender' => $request->input('gender', $user->gender),
            'birth_day' => $request->input('birth_day', $user->birth_day),
        ]);


        return back()->with('success', __('global.Profile Updated'));
    }
}
