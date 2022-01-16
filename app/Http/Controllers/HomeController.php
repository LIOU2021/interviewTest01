<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // dd(Ticket::find(Auth::user()->group_id));
            $data = Ticket::where('group_id',Auth::user()->group_id)->with('user')->get();
            return view('app', compact('data'));
        } else {
            return view('app');
        }
    }

    public function ticket(Request $request, $id)
    {
        $data = Ticket::find($id);
        if($data->group_id != Auth::user()->group_id){
            return redirect()->route('home')->withErrors('無權限訪問');
        }
        return view('ticket',compact('data'));
    }
}
