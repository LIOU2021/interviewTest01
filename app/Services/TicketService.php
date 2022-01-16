<?php

namespace App\Services;

use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\EditTicketRequest;
use App\Http\Requests\VerifyRequest;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    public function createTestCase(CreateTicketRequest $request)
    {
        if (Auth::user()->canCreateTestCase()) {
            if(Ticket::create($request->all())){
                return redirect()->back()->with('msg','新增成功');
            };
            return redirect()->back()->withErrors('新增失敗');
        } else {
            return redirect()->back()->withErrors('無權限操作!');
        }
    }
    
    public function createFeatureRequest(CreateTicketRequest $request)
    {
        if (Auth::user()->canCreateFeatureRequest()) {
            if(Ticket::create($request->all())){
                return redirect()->back()->with('msg','新增成功');
            };
            return redirect()->back()->withErrors('新增失敗');
        } else {
            return redirect()->back()->withErrors('無權限操作!');
        }
    }

    public function createBug(CreateTicketRequest $request)
    {
        if (Auth::user()->canCreateBug()) {
            if(Ticket::create($request->all())){
                return redirect()->back()->with('msg','新增成功');
            };
            return redirect()->back()->withErrors('新增失敗');
        } else {
            return redirect()->back()->withErrors('無權限操作!');
        }
    }

    public function editBug(EditTicketRequest $request)
    {
        if (Auth::user()->canEditBug()) {
            if($request->type != '1'){
                return redirect()->back()->withErrors('此筆項目並非bug');
            }
            if(Ticket::find($request->id)->update($request->all())){
                return redirect()->back()->with('msg','更新成功');
            };
            return redirect()->back()->withErrors('更新失敗');
        } else {
            return redirect()->back()->withErrors('無權限操作!');
        }
    }

    public function deleteBug(VerifyRequest $request)
    {
        if (Auth::user()->canDeleteBug()) {
            $ticket = Ticket::find($request->id);
            $ticket->delete();
            return 'success';
        } else {
            return 'fail';
        }
    }

    public function resolveBug(VerifyRequest $request)
    {
        if (Auth::user()->canResolveBug()) {
            $ticket = Ticket::find($request->id);
            $ticket->status="2";
            $ticket->save();
            return 'success';
        } else {
            return 'fail';
        }
    }

    public function resolveFeatureRequest(VerifyRequest $request){
        if (Auth::user()->canResolveFeatureRequest()) {
            $ticket = Ticket::find($request->id);
            $ticket->status="2";
            $ticket->save();
            return 'success';
        } else {
            return 'fail';
        }
    }

    public function resolveTestCase(VerifyRequest $request){
        if (Auth::user()->canResolveTestCase()) {
            $ticket = Ticket::find($request->id);
            $ticket->status="2";
            $ticket->save();
            return 'success';
        } else {
            return 'fail';
        }
    }
}
