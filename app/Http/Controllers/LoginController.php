<?php

namespace App\Http\Controllers;

use App\Http\Requests\CusRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
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
        $group=Group::where('token',$request->token)->first();
        $adminCounter = User::where('group_id',$group->id)->where('type','4')->get()->count();
        $data = $request->all();
        $data['password']=Hash::make($data['password']);
        $data['group_id']=$group->id;
        
        if(!$adminCounter && $data['type']=='4'){
            $data['verify']=Carbon::now();
        }

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
        ->with('msg', 'group name註冊成功!')
        ->with('token', 'token為'.$token);
    }
}
