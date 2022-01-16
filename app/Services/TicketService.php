<?php

namespace App\Services;

use App\Http\Requests\VerifyRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    public function test()
    {
        return Auth::user()->canCreateBug();
    }

    public function createBug()
    {
        if (Auth::user()->canCreateBug()) {
            return 'success';
        } else {
            return 'fail';
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
