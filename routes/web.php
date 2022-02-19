<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use \App\Http\Controllers\Admin\DashboardController;
use \App\Http\Controllers\Admin\UserController as UserControllerAdmin;
use \App\Http\Controllers\Customer\UserController as UserControllerCustomer;

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
    return Inertia::render('LandingPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('landingpage');
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['guest']], function () {
        Route::get('/login', [UserControllerAdmin::class, 'login'])->name('login.admin');
        Route::get('/register', [UserControllerAdmin::class, 'register'])->name('register.admin');
    });
    Route::group(['middleware' => ['auth:sanctum', 'verified', 'is_admin']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/user/store', [UserControllerAdmin::class, 'store'])->name('user.store');
        Route::put('/user/update/{id}', [UserControllerAdmin::class, 'update'])->name('user.update');
        Route::put('/user/approve/{id}', [UserControllerAdmin::class, 'approve_user'])->name('user.approve');
        Route::get('/user/detail/{id}', [UserControllerAdmin::class, 'detail'])->name('user.detail');
        Route::delete('/user/delete/{id}', [UserControllerAdmin::class, 'delete_user'])->name('user.delete');

    });
});

Route::group(['prefix' => 'customer'], function () {
    Route::group(['middleware' => ['auth:sanctum', 'verified', 'is_customer']], function () {
        Route::get('/home', [UserControllerCustomer::class, 'profile'])->name('customer.home');
    });
});
