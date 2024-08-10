<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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


Route::prefix('admin')->middleware('auth', 'role:owner|dev|full')->group(function () {
    Route::get('dashboard', [HomeController::class, 'home'])->name('dashboard');

    // Route::post('change/user/password/{user}', [UserController::class, "updateUserPassword"])->name('update.user.password');

    // Route::get('home', [HomeController::class, 'home'])->name('home');

    Route::get('lang/{lang}', [HomeController::class, 'switchLang'])->name('lang.switch');

    Route::post('sidenav-toggled', [HomeController::class, 'sidenavToggled'])->name('sidenav.toggled');

    Route::get('edit-profile', [HomeController::class, 'editProfile'])->name('edit.profile');

    Route::post('update-password', [HomeController::class, 'updatePassword'])->name('update.password');

    Route::post('update-profile', [HomeController::class, 'updateProfile'])->name('update.profile');

    Route::middleware('permission:index-user')->get('users', [UserController::class, 'index'])->name('user.index');
    Route::middleware('permission:index-user')->get('user/{user}', [UserController::class, 'show'])->name('user.show');

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
});
