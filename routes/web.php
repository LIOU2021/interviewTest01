<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Services\TicketService;
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

Route::middleware("auth")->group(function(){
    Route::prefix('resolve')->name('resolve.')->middleware('verifyToken')->group(function(){
        Route::post('bug',[TicketService::class,'resolveBug'])->name('bug');
        Route::post('featureRequest',[TicketService::class,'resolveFeatureRequest'])->name('featureRequest');
        Route::post('testCase',[TicketService::class,'resolveTestCase'])->name('testCase');
    });
    
    Route::get('ticket/{id}',[HomeController::class,'ticket']);
    
    Route::prefix('delete')->middleware('verifyToken')->name('delete.')->group(function(){
        Route::post('bug',[TicketService::class,'deleteBug'])->name('bug');

    });

    Route::prefix('update')->middleware('verifyToken')->name('update.')->group(function(){
        Route::post('bug',[TicketService::class,'editBug'])->name('bug');

    });

    Route::prefix('create')->middleware('verifyToken')->name('create.')->group(function(){
        Route::post('bug',[TicketService::class,'createBug'])->name('bug');
        Route::post('featureRequest',[TicketService::class,'createFeatureRequest'])->name('featureRequest');
        Route::post('testCase',[TicketService::class,'createTestCase'])->name('testCase');
    });
});