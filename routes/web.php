<?php

use App\Http\Controllers\DailyTaskController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Web\WebReportController;
use App\Http\Controllers\Web\WebTaskController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
    // return view('welcome');
});


require __DIR__ . '/auth.php';


Route::get('seed', function () {
    Artisan::call('db:seed --force');
    return 'Seed Done';
});

Route::get('npm', function () {
    $output = shell_exec('npm install && npm run build');
    return 'Seed Done - ' . json_encode($output);
});

Route::get('migrate', function (Request $request) {
    if ($request->has('s1')) {
        Artisan::call('migrate:refresh --force');
        return 'Seed Done';
    }

    if ($request->has('s2')) {
        Artisan::call('db:seed --force');
        return 'Seed Done';
    }

    if ($request->has('s3')) {
        Artisan::call('passport:install');
        return 'Seed Done';
    }

    return 'Seed NOT Done';
});

Route::get('lang/{lang}', [HomeController::class, 'switchLang'])->name('lang.switch');

Route::get('web/task/{slug}', [WebTaskController::class, 'openTask'])->name('web.task');

Route::prefix('admin')->middleware('auth', 'role:owner|manager|employee')->group(function () {
    Route::get('dashboard', [HomeController::class, 'home'])->name('dashboard');

    Route::get('task-board', [HomeController::class, 'taskBoard'])->name('task-board');

    Route::get('dailytask/{dailytask}', [DailyTaskController::class, 'livewireShow'])->name('dailytask.show');

    // Route::post('change/user/password/{user}', [UserController::class, "updateUserPassword"])->name('update.user.password');

    // Route::get('home', [HomeController::class, 'home'])->name('home');

    Route::get('set-session/{id}', [HomeController::class, 'logInAsUser'])->name('set-session');

    Route::post('sidenav-toggled', [HomeController::class, 'sidenavToggled'])->name('sidenav.toggled');

    Route::get('edit-profile', [HomeController::class, 'editProfile'])->name('edit.profile');

    Route::post('update-password', [HomeController::class, 'updatePassword'])->name('update.password');

    Route::post('update-profile', [HomeController::class, 'updateProfile'])->name('update.profile');


    Route::get('reports', [WebReportController::class, 'indexReports'])->name('view-reports');

    Route::middleware('permission:index-user')->get('users', [UserController::class, 'index'])->name('user.index');
    Route::middleware('permission:show-user')->get('user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::middleware('permission:show-user')->get('user/{id}/report', [UserController::class, 'showReport'])->name('user.show.report');

    // 
    // the full routes for otpsendcodes
    Route::middleware('permission:index-otpsendcode')->get('otpsendcodes', [App\Http\Controllers\OtpSendCodeController::class, 'livewireIndex'])->name('otpsendcode.index');
    Route::middleware('permission:restore-otpsendcode')->get('trash/otpsendcodes', [App\Http\Controllers\OtpSendCodeController::class, 'livewireDeletedIndex'])->name('otpsendcode.index.trash');
    Route::get('export/otpsendcodes', [App\Http\Controllers\OtpSendCodeController::class, 'exportFullData'])->name('otpsendcode.export');
    Route::post('import/otpsendcodes', [App\Http\Controllers\OtpSendCodeController::class, 'importData'])->name('otpsendcode.import');


    // the full routes for devicetokenlists
    Route::middleware('permission:index-devicetokenlist')->get('devicetokenlists', [App\Http\Controllers\DeviceTokenListController::class, 'livewireIndex'])->name('devicetokenlist.index');
    Route::middleware('permission:restore-devicetokenlist')->get('trash/devicetokenlists', [App\Http\Controllers\DeviceTokenListController::class, 'livewireDeletedIndex'])->name('devicetokenlist.index.trash');
    Route::get('export/devicetokenlists', [App\Http\Controllers\DeviceTokenListController::class, 'exportFullData'])->name('devicetokenlist.export');
    Route::post('import/devicetokenlists', [App\Http\Controllers\DeviceTokenListController::class, 'importData'])->name('devicetokenlist.import');


    // the full routes for passwordcodes
    Route::middleware('permission:index-passwordcode')->get('passwordcodes', [App\Http\Controllers\PasswordCodeController::class, 'livewireIndex'])->name('passwordcode.index');
    Route::middleware('permission:restore-passwordcode')->get('trash/passwordcodes', [App\Http\Controllers\PasswordCodeController::class, 'livewireDeletedIndex'])->name('passwordcode.index.trash');
    Route::get('export/passwordcodes', [App\Http\Controllers\PasswordCodeController::class, 'exportFullData'])->name('passwordcode.export');
    Route::post('import/passwordcodes', [App\Http\Controllers\PasswordCodeController::class, 'importData'])->name('passwordcode.import');


    // the full routes for devicetokenlists
    Route::middleware('permission:index-devicetokenlist')->get('devicetokenlists', [App\Http\Controllers\DeviceTokenListController::class, 'livewireIndex'])->name('devicetokenlist.index');
    Route::middleware('permission:restore-devicetokenlist')->get('trash/devicetokenlists', [App\Http\Controllers\DeviceTokenListController::class, 'livewireDeletedIndex'])->name('devicetokenlist.index.trash');
    Route::get('export/devicetokenlists', [App\Http\Controllers\DeviceTokenListController::class, 'exportFullData'])->name('devicetokenlist.export');
    Route::post('import/devicetokenlists', [App\Http\Controllers\DeviceTokenListController::class, 'importData'])->name('devicetokenlist.import');


    // the full routes for tasks
    Route::middleware('permission:index-task')->get('tasks', [App\Http\Controllers\TaskController::class, 'livewireIndex'])->name('task.index');

    Route::middleware('permission:show-task')->get('task/{task}', [App\Http\Controllers\TaskController::class, 'livewireShow'])->name('task.show');

    Route::middleware('permission:show-task')->get('task/{task}/report', [TaskController::class, 'showReport'])->name('task.show.report');

    Route::middleware('permission:restore-task')->get('trash/tasks', [App\Http\Controllers\TaskController::class, 'livewireDeletedIndex'])->name('task.index.trash');
    Route::get('export/tasks', [App\Http\Controllers\TaskController::class, 'exportFullData'])->name('task.export');
    Route::post('import/tasks', [App\Http\Controllers\TaskController::class, 'importData'])->name('task.import');


    // the full routes for attachments
    Route::middleware('permission:index-attachment')->get('attachments', [App\Http\Controllers\AttachmentController::class, 'livewireIndex'])->name('attachment.index');
    Route::middleware('permission:restore-attachment')->get('trash/attachments', [App\Http\Controllers\AttachmentController::class, 'livewireDeletedIndex'])->name('attachment.index.trash');
    Route::get('export/attachments', [App\Http\Controllers\AttachmentController::class, 'exportFullData'])->name('attachment.export');
    Route::post('import/attachments', [App\Http\Controllers\AttachmentController::class, 'importData'])->name('attachment.import');


    // the full routes for comments
    Route::middleware('permission:index-comment')->get('comments', [App\Http\Controllers\CommentController::class, 'livewireIndex'])->name('comment.index');
    Route::middleware('permission:restore-comment')->get('trash/comments', [App\Http\Controllers\CommentController::class, 'livewireDeletedIndex'])->name('comment.index.trash');
    Route::get('export/comments', [App\Http\Controllers\CommentController::class, 'exportFullData'])->name('comment.export');
    Route::post('import/comments', [App\Http\Controllers\CommentController::class, 'importData'])->name('comment.import');


    // the full routes for extratimes
    Route::middleware('permission:index-extratime')->get('extratimes', [App\Http\Controllers\ExtraTimeController::class, 'livewireIndex'])->name('extratime.index');
    Route::middleware('permission:restore-extratime')->get('trash/extratimes', [App\Http\Controllers\ExtraTimeController::class, 'livewireDeletedIndex'])->name('extratime.index.trash');
    Route::get('export/extratimes', [App\Http\Controllers\ExtraTimeController::class, 'exportFullData'])->name('extratime.export');
    Route::post('import/extratimes', [App\Http\Controllers\ExtraTimeController::class, 'importData'])->name('extratime.import');


    // the full routes for leaves
    Route::middleware('permission:index-leave')->get('leaves', [App\Http\Controllers\LeaveController::class, 'livewireIndex'])->name('leave.index');
    Route::middleware('permission:restore-leave')->get('trash/leaves', [App\Http\Controllers\LeaveController::class, 'livewireDeletedIndex'])->name('leave.index.trash');
    Route::get('export/leaves', [App\Http\Controllers\LeaveController::class, 'exportFullData'])->name('leave.export');
    Route::post('import/leaves', [App\Http\Controllers\LeaveController::class, 'importData'])->name('leave.import');


    // the full routes for discounts
    Route::middleware('permission:index-discount')->get('discounts', [App\Http\Controllers\DiscountController::class, 'livewireIndex'])->name('discount.index');
    Route::middleware('permission:restore-discount')->get('trash/discounts', [App\Http\Controllers\DiscountController::class, 'livewireDeletedIndex'])->name('discount.index.trash');
    Route::get('export/discounts', [App\Http\Controllers\DiscountController::class, 'exportFullData'])->name('discount.export');
    Route::post('import/discounts', [App\Http\Controllers\DiscountController::class, 'importData'])->name('discount.import');


    // the full routes for dailytasks
    Route::middleware('permission:index-dailytask')->get('dailytasks', [App\Http\Controllers\DailyTaskController::class, 'livewireIndex'])->name('dailytask.index');
    Route::middleware('permission:restore-dailytask')->get('trash/dailytasks', [App\Http\Controllers\DailyTaskController::class, 'livewireDeletedIndex'])->name('dailytask.index.trash');
    Route::get('export/dailytasks', [App\Http\Controllers\DailyTaskController::class, 'exportFullData'])->name('dailytask.export');
    Route::post('import/dailytasks', [App\Http\Controllers\DailyTaskController::class, 'importData'])->name('dailytask.import');


    // the full routes for loghistories
    Route::middleware('permission:index-loghistory')->get('loghistories', [App\Http\Controllers\LogHistoryController::class, 'livewireIndex'])->name('loghistory.index');
    Route::middleware('permission:restore-loghistory')->get('trash/loghistories', [App\Http\Controllers\LogHistoryController::class, 'livewireDeletedIndex'])->name('loghistory.index.trash');
    Route::get('export/loghistories', [App\Http\Controllers\LogHistoryController::class, 'exportFullData'])->name('loghistory.export');
    Route::post('import/loghistories', [App\Http\Controllers\LogHistoryController::class, 'importData'])->name('loghistory.import');


    // the full routes for departments
    Route::middleware('permission:index-department')->get('departments', [App\Http\Controllers\DepartmentController::class, 'livewireIndex'])->name('department.index');
    Route::middleware('permission:restore-department')->get('trash/departments', [App\Http\Controllers\DepartmentController::class, 'livewireDeletedIndex'])->name('department.index.trash');
    Route::get('export/departments', [App\Http\Controllers\DepartmentController::class, 'exportFullData'])->name('department.export');
    Route::post('import/departments', [App\Http\Controllers\DepartmentController::class, 'importData'])->name('department.import');


    // the full routes for branches
    Route::middleware('permission:index-branch')->get('branches', [App\Http\Controllers\BranchController::class, 'livewireIndex'])->name('branch.index');

    Route::middleware('permission:index-branch')->get('branch/{branch}', [App\Http\Controllers\BranchController::class, 'livewireShow'])->name('branch.show');

    Route::middleware('permission:restore-branch')->get('trash/branches', [App\Http\Controllers\BranchController::class, 'livewireDeletedIndex'])->name('branch.index.trash');
    Route::get('export/branches', [App\Http\Controllers\BranchController::class, 'exportFullData'])->name('branch.export');
    Route::post('import/branches', [App\Http\Controllers\BranchController::class, 'importData'])->name('branch.import');

    // the full routes for companies
    Route::middleware('permission:index-company')->get('companies', [App\Http\Controllers\CompanyController::class, 'livewireIndex'])->name('company.index');

    Route::middleware('permission:show-company')->get('company/{company}', [App\Http\Controllers\CompanyController::class, 'livewireShow'])->name('company.show');

    Route::middleware('permission:restore-company')->get('trash/companies', [App\Http\Controllers\CompanyController::class, 'livewireDeletedIndex'])->name('company.index.trash');
    Route::get('export/companies', [App\Http\Controllers\CompanyController::class, 'exportFullData'])->name('company.export');
    Route::post('import/companies', [App\Http\Controllers\CompanyController::class, 'importData'])->name('company.import');

    // the full routes for areas
    Route::middleware('permission:index-area')->get('areas', [App\Http\Controllers\AreaController::class, 'livewireIndex'])->name('area.index');
    Route::middleware('permission:restore-area')->get('trash/areas', [App\Http\Controllers\AreaController::class, 'livewireDeletedIndex'])->name('area.index.trash');
    Route::get('export/areas', [App\Http\Controllers\AreaController::class, 'exportFullData'])->name('area.export');
    Route::post('import/areas', [App\Http\Controllers\AreaController::class, 'importData'])->name('area.import');
});



// Route::get('tr', function () {
//     $date = date('Y-m-d\TH:i');

//     $tasks = Task::whereIn('status', ['pending', 'active',])
//         ->where('end_time', '<=', $date)->get();

//     // php /home/forge/task-manager.codexal.co/artisan task:auto-finish
//     // php /home/forge/task-manager.codexal.co/artisan task:urgent-reminder

//     return $tasks;
// });


// Route::get('id/{id}', function ($id) {
//     $task = Task::find($id);
//     $task->all_comments();
//     return [
//         'comments' => $task->all_comments(),
//         'have_new_comment' => $task->have_new_comment(),
//         'have_new_attachment' => $task->have_new_attachment(),
//         'task' => $task,
//     ];
// });

Route::get('urg', function () {
    // $date = date('Y-m-d\TH:i', strtotime('+12 Hours'));
    $date = date('Y-m-d\TH:i');

    $tasks = Task::whereNullOrEmptyOrZero('main_task_id')->whereNullOrEmpty('slug');

    $tasks = $tasks->where('priority_level', 'urgent')
        ->whereIn('status', ['pending', 'active',]);

    $tasks = $tasks->where('end_time', '>=', $date)->get();

    return $tasks;
});
