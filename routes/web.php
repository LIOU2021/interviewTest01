<?php

use App\Http\Controllers\LoginController;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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
    return view('app');
})->name('home');

Route::middleware('guest')->group(function(){
    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login',[LoginController::class,'login']);
    Route::get('/signUp',[LoginController::class,'signUp'])->name('signUp');
    Route::post('/signUp',[LoginController::class,'signUpAct']);
});

Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('signUpCus',[LoginController::class,'signUpCus'])->name('signUpCus');
Route::post('signUpCus',[LoginController::class,'signUpCusAct']);

Route::get('test',function(){
return Hash::make('password');
    //  dd(User::where('email','aa78789898etw@gmail.com')->first());
    // $password = bcrypt('secret');
    // dd(Hash::check('secret', $password));
    // return !Customer::find(30);
});