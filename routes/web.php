<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    ChambreController,
    ForgotController,
    UserController,
    RegisterController,
    LoginController,
    LogoutController,
    ResetController,
    CategoryController,
    DisponibiliteController,
    ReservationController
};

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
Route::get('register',[RegisterController::class,'index'])->name('register');
Route::get('login',[LoginController::class,'index'])->name('login');
Route::get('logout',[LogoutController::class, 'logout'])->name('logout');
Route::get('forgot',[ForgotController::class,'index'])->name('forgot');
Route::get('reset/{token}',[ResetController::class,'index'])->name('reset');
Route::get('category/{category}',[CategoryController::class,'show'])->name('category.show');
Route::get('disponibilite/{disponibilite}',[DisponibiliteController::class,'show'])->name('disponibilite.show');
Route::get('chambres',[ChambreController::class,'show'])->name('chambres.show');

Route::post('reset',[ResetController::class,'reset'])->name('post.reset');

Route::post('register',[RegisterController::class,'register'])->name('post.register');
Route::post('login',[LoginController::class,'login'])->name('post.login');
Route::post('forgot',[ForgotController::class,'store'])->name('post.forgot');



Route::get('profile/{user}', [UserController::class, 'profile'])->name('user.profile');
Route::resource('chambres', ChambreController::class);
Route::resource('reservations', ReservationController::class);
Route::get('/', function () {
    return view('layouts.home');
});

Route::get('facture', function () {
    return view('reservation.facture');
});