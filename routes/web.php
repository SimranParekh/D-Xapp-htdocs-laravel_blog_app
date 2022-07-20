<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
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
    return view('welcome');
});
//blogs 
Route::get('blogs', [BlogController::class, 'index'])->name('blogs'); 
Route::get('blog-create', [BlogController::class, 'create'])->name('blogs.create'); 
Route::post('blog-store', [BlogController::class, 'store'])->name('blogs.store');
Route::get('blog-filter', [BlogController::class, 'filter'])->name('blogs.filter');

//auth
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login_store', [AuthController::class, 'Login'])->name('login.store'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('registration_store', [AuthController::class, 'Registration_store'])->name('register.store'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');