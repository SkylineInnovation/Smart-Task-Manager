<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\DailyTask;
use App\Models\LogHistory;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public static function saveImageWeb($image, $folderName)
    {
        $theImageUrl_image = null;

        if (is_string($image)) return $image;

        if ($image) {
            $theImageName_image = $folderName . '_' . Str::random(10) . '.' . $image->extension();
            $image->storeAs($folderName, $theImageName_image);
            $theImageUrl_image = $folderName . '/' . $theImageName_image;

            // try {
            //     Image::load($theImageUrl_image)->quality(25)
            //         // ->width(300)->height(300)
            //         ->save(storage_path('app/' . $theImageUrl_image));
            // } catch (\Throwable $th) {
            // }
        }

        return $theImageUrl_image;
    }

    public function switchLang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        return Redirect::back();
    }

    public function logInAsUser($id)
    {
        if ($id == 0) {
            $user = session()->get('admin_user');
            if (!$user) return;

            Auth::logout();

            Auth::login($user);

            session()->forget('admin_user');
        } else {
            if (!session()->has('admin_user'))
                session()->put('admin_user', Auth::user());

            $user = User::find($id);
            if (!$user) return;

            Auth::logout();

            Auth::login($user);
        }

        return back();
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

    public function home(Request $request)
    {
        $company = \App\Models\Company::latest()->first();
        $mainBtns = [
            [
                'image' => asset('assets/dashboard/company.png'),
                'text' =>  __('global.company'),
                'link' => $company ? route('company.show', $company) : '#',
            ],
            [
                'image' => asset('assets/dashboard/region.png'),
                'text' =>  __('global.region'),
                'link' => route('area.index'),
            ],
            [
                'image' => asset('assets/dashboard/branch.png'),
                'text' =>  __('global.branch'),
                'link' => route('branch.index'),
            ],
            [
                'image' => asset('assets/dashboard/department.png'),
                'text' =>  __('global.departments'),
                'link' => route('department.index'),
            ],
            [
                'image' => asset('assets/dashboard/person.png'),
                'text' =>  __('global.person'),
                'link' => route('user.index'),
            ],
            [
                'image' => asset('assets/dashboard/employee.png'),
                'text' =>  __('global.job'),
                'link' => route('work.index'),
            ],
            [
                'image' => asset('assets/dashboard/team.png'),
                'text' =>  __('global.permissions'),
            ],
            [
                'image' => asset('assets/dashboard/report.png'),
                'text' =>  __('global.report'),
                'link' => route('view-reports'),
            ],
            [
                'image' => asset('assets/dashboard/profile.png'),
                'text' =>  __('global.profile'),
                'link' => route('edit.profile'),
            ],
            [
                'image' => asset('assets/dashboard/about.png'),
                'text' =>  __('global.about'),
            ],
        ];

        $actionBtns = [
            [
                'text' =>  __('global.add-permissions'),
            ],
        ];

        $tasksBtns = [
            [
                'image' => asset('assets/dashboard/task.png'),
                'text' =>  __('global.tasks'),
                'link' => route('task.index'),
            ],
            [
                'image' => asset('assets/dashboard/deduction.png'),
                'text' =>  __('global.discounts'),
                'link' => route('discount.index'),
            ],
            [
                'image' => asset('assets/dashboard/ticket.png'),
                'text' =>  __('global.leaves'),
                'link' => route('leave.index'),
            ],
            [
                'image' => asset('assets/dashboard/notice.png'),
                'text' =>  __('global.exchangepermissions'),
                'link' => route('exchangepermission.index'),
            ],
        ];

        $users = Auth::user()->id;
        $tasksInDashboard = Task::whereHas('employees', function ($q) use ($users) {
            $q->where('user_id', $users);
        })->get();

        // //    Incoming tasks not commented on today
        // $ITNCOT = Task::whereHas('employees', function ($q) use ($users) {
        //     $q->where('user_id', $users);
        // })->where('status', 'active')->whereDoesntHave('comments')->whereDate('created_at', Carbon::today())->get();

        // // Outgoing tasks not commented on today
        // $OTNCOT = Task::where('manager_id',)->whereDoesntHave('comments')->whereDate('created_at', Carbon::today())->get();


        // DONE
        // مهام واردة لم يعلق عليها اليوم
        $income_tasks_not_commented = Task::whereHas('employees', function ($q) use ($users) {
            $q->where('user_id', $users);
        })->whereDoesntHave('today_comments')->where('end_time', '>=', date('Y-m-d\TH:i'))->get();


        // مهام صادرة لم يعلق عليها اليوم
        $outcome_tasks_not_commented = Task::where('manager_id', $users)
            ->whereDoesntHave('today_comments')->where('end_time', '>=', date('Y-m-d\TH:i'))->get();


        // مهام واردة أوشكت على الإغلاق
        $income_tasks_almost_close = Task::whereHas('employees', function ($q) use ($users) {
            $q->where('user_id', $users);
        })->where('start_time', '>=', date('Y-m-d\T00:00'))->where('end_time', '<=', date('Y-m-d\TH:i', strtotime('+3 Days')))->get();


        // مهام صادرة أوشكت على الإغلاق
        $outcome_tasks_almost_close = Task::where('manager_id', $users)
            ->where('start_time', '>=', date('Y-m-d\T00:00'))
            ->where('end_time', '<=', date('Y-m-d\TH:i', strtotime('+3 Days')))->get();


        $all_history = LogHistory::whereBetween('created_at', [date('Y-m-d H:i:s', strtotime('-1 Days')), date('Y-m-d H:i:s')])->get();


        return view('home', compact(
            'mainBtns',
            'actionBtns',
            'tasksBtns',
            'tasksInDashboard',
            'income_tasks_not_commented',
            'outcome_tasks_not_commented',
            'income_tasks_almost_close',
            'outcome_tasks_almost_close',
            'all_history',
        ));
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

        // $request->validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'user_name' => 'required',
        //     'email' => 'required',
        //     'phone' => 'required',
        //     'gender' => 'required',
        //     'birth_day' => 'required',
        // ]);

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

    public function taskBoard()
    {
        return view('Web.task-board');
    }

    public function permissionPage()
    {
        return view('Web.permissions.permissions');
    }
}
