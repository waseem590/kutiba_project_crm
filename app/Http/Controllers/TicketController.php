<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use App\Models\User;
use App\Models\TicketComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Notifications\TicketNotification;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_id = Auth::id();
        $auth_role = Auth::user()->roles->first();
        // dd($auth_role);
        if($auth_role->id == 6){
            $tickets = Ticket::with('users')->latest()->get();
        } else {
            $tickets = Ticket::where('users_id', $auth_id)->with('users')->latest()->get();
        }
        return view('admin.pages.ticket.showTicketList', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('type', '!=', '6')->get();
        return view('admin.pages.ticket.generateTicket', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {
        $data = $request->validated();
        $data['ticket_no'] = strtoupper(Str::random(10));
        $user = User::where('id', $data['users_id'])->first();
        $ticket = Ticket::create([
            'users_id' => $data['users_id'],
            'ticket_no' => $data['ticket_no'],
            'title' => $data['title'],
            'periority' => $data['periority'],
            'message' => $data['message'],
            'status' => 'open',
        ]);
        $ticket['name'] = $user->name;
        $ticket['notifi_title'] = "Ticket";
        // dd($ticket);
        $user->notify(new TicketNotification($ticket));
        // dd($ticket);
        \LogActivity::addToLog('Ticket generated, ticket_no' . $data['ticket_no']);
        \LogActivity::addToLog('Ticket generated, Notificstion sent to user' . $data['ticket_no'] . ' Username:' . $user->name);
        return redirect()->route('ticket.showList');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth_id = Auth::id();
        $auth_role = Auth::user()->roles->first();
        $ticket = Ticket::with('users')->where('id', $id)->first();
        $ticketComments = TicketComment::whereHas('tickets', function ($query) use ($ticket) {
            $query->where('tickets_id', $ticket->id);
        })->with('tickets')->with('users')->get();
        // dd($ticket);
        if($auth_id == 1 || $auth_id == $ticket->users->id){
        // dd($ticketComments);
            return view('admin.pages.ticket.showTicket', compact('ticket', 'ticketComments'));
        } else {
            $tickets = Ticket::where('users_id', $auth_id)->with('users')->latest()->get();
            return redirect()->route('ticket.showList');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $data = $request->validated();
        // return $request->id;
        $ticket_update = Ticket::whereId($request->id)->update([
            'status' => $request->status,
        ]);

        $ticket = Ticket::where('id',$request->id)->with('users')->first();
        $ticket['notifi_title'] = 'Ticket';
        $user = $ticket->users;
        $user->notify(new TicketNotification($ticket));
        // // dd($ticket);
        \LogActivity::addToLog('Ticket updated, ticket_no' . $ticket['ticket_no']);
        \LogActivity::addToLog('Ticket updated, Notificstion sent to user' . $ticket['ticket_no'] . ' Username:' . $user->name);

        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ticket = Ticket::whereId($request->id)->first();
        Ticket::whereId($request->id)->delete();
        $ticketComments =  TicketComment::where('tickets_id', $ticket->id)->delete();
        // return $ticketComments;
        // foreach($ticketComments as $ticketComment){

        // }
        \LogActivity::addToLog('Tickets and its comments are deleted: '.$ticket['ticket_no']);
            return response()->json('success');
    }
}
