<?php

namespace App\Http\Controllers;

use App\Http\Requests\CusRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        if(Auth::attempt($credentials)){
            return redirect()->route('home');
        }

        return redirect()->back()->with('msg','登入失敗!');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function signUp()
    {
        return view('signUp');
    }

    public function signUpAct(SignUpRequest $request)
    {
        $data = $request->all();
        $data['password']=Hash::make($data['password']);
        $data['group_id']=Group::where('token',$request->token)->first()->id;
        if(User::create($data)){
            return redirect()->route('login')->with('msg','註冊成功');
        }
    }

    public function signUpCus()
    {
        return view('signUpCus');
    }

    public function signUpCusAct(CusRequest $request)
    {
        $data = Group::create([
            'name' => $request->name,
            'token' => Group::getToken(),
        ]);
        $token = Group::where('name',$data->name)->first()->token;
        return redirect()->route('login')
        ->with('msg', 'customer name註冊成功!')
        ->with('token', 'token為'.$token);
    }
}
