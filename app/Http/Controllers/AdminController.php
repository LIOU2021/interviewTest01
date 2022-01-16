<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function userIndex()
    {
        $data = User::where('group_id', Auth::user()->group_id)->get();
        return view('admin.user', compact('data'));
    }

    public function allowVerify(VerifyRequest $request)
    {
        $getIdFromGroup = Group::where('token', $request->token)->first()->id;
        $allow = User::where('group_id',$getIdFromGroup)->where('id',$request->id)->get()->count();
        if ($allow) {
            $userId = $request->id;
            $user = User::find($userId);
            $user->verify = Carbon::now();
            if ($user->save()) {
                return 'success';
            }
        }
        return 'fail';
    }

    public function delete(VerifyRequest $request){
        $getIdFromGroup = Group::where('token', $request->token)->first()->id;
        $allow = User::where('group_id',$getIdFromGroup)->where('id',$request->id)->get()->count();
        if ($allow) {
            $userId = $request->id;
            $user = User::find($userId);
            if ($user->delete()) {
                return 'success';
            }
        }
        return 'fail';
    }
}
