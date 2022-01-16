<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class,'index'])->name('home');

Route::middleware('guest')->group(function(){
    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login',[LoginController::class,'login'])->middleware('userVerify');
    Route::get('/signUp',[LoginController::class,'signUp'])->name('signUp');
});
Route::post('/signUp',[LoginController::class,'signUpAct']);

Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('signUpCus',[LoginController::class,'signUpCus'])->name('signUpCus');
Route::post('signUpCus',[LoginController::class,'signUpCusAct']);

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function(){
    Route::middleware('onlyAdmin')->group(function(){
        Route::get('user',[AdminController::class,"userIndex"])->name('user');
        Route::post('verify',[AdminController::class,"allowVerify"])->name('verify');
        Route::post('delete',[AdminController::class,"delete"])->name('delete');
    });

});

Route::get('test',function(Request $request){
    if(($request->is('test'))){
        return 'yes';
    }else{
        return 'no';
    }
});