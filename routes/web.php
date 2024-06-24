<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
    Route::get('billing', function () { 
        return view('pages.billing');
    })->name('billing');
    // Route::get('tables', function () {
    //     return view('pages.tables');
    // })->name('tables');
    Route::get('rtl', function () {
        return view('pages.rtl');})->name('rtl');
    Route::get('virtual-reality', function () {
        return view('pages.virtual-reality');
        })->name('virtual-reality');
    Route::get('notifications', function () {
        return view('pages.notifications');
        })->name('notifications');
    Route::get('static-sign-in', function () {
        return view('pages.static-sign-in');
        })->name('static-sign-in');
    Route::get('static-sign-up', function () {
        return view('pages.static-sign-up');
        })->name('static-sign-up');
    Route::get('user-management', function () {
        return view('pages.laravel-examples.user-management');
        })->name('user-management');
    Route::get('user-profile', function () {
        return view('pages.laravel-examples.user-profile');
        })->name('user-profile');});

Route::get('tables', [RegisterController::class, 'ShowUserlist'])->name('tables');

Route::resource('/product', ProductController::class);
Route::get('tables',[ProductController::class, 'ShowProductList'])->name('tables');

Route::resource('/order', OrderController::class);
Route::get('tables',[OrderController::class, 'ShowProductList'])->name('tables');
Route::get('billing',[OrderController::class, 'ShowOrder'])->name('billing');