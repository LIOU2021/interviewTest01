<?php

namespace App\Http\Middleware;

use App\Models\Group;
use App\Models\Ticket;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->is("create/*")){
            $group_id=$request->group_id;
        }else{
            $group_id=Ticket::find($request->id)->group_id;
        }
        
        $authGroupId=Group::where('token',Auth::user()->getToken())->first()->id;
        // dd(compact('group_id','authGroupId'));
        if((string)$group_id == (string)$authGroupId){
            return $next($request);
        }
        return redirect()->route('home')->withErrors('token與請求比對不一致');
        
    }
}
