<?php

namespace App\Http\Controllers;

use App\Http\Requests\CusRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        return 'use post login';
    }

    public function signUp()
    {
        return view('signUp');
    }

    public function signUpAct(SignUpRequest $request)
    {
        if(User::create($request->all())){
            return redirect()->route('login')->with('msg','註冊成功');
        }
    }

    public function signUpCus()
    {
        return view('signUpCus');
    }

    public function signUpCusAct(CusRequest $request)
    {

        echo $request->name;
        echo Customer::getToken();
        Customer::create([
            'name' => $request->name,
            'token' => Customer::getToken(),
        ]);
        return redirect()->route('login')->with('msg', 'customer name註冊成功!');
    }
}
