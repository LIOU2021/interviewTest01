<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::check()){
            $data='';
            return view('app',compact('data'));
        }else{
            return view('app');
        }
    }
}
