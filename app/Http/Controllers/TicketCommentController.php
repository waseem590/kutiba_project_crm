<?php

namespace App\Http\Controllers;

use App\Models\TicketComment;
use Illuminate\Http\Request;
use App\Http\Requests\TicketCommentRequest;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TicketCommentNotification;

class TicketCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketCommentRequest $request)
    {
        $auth_user = Auth::id();
        // dd($auth_user);
        $data = $request->validated();
        $user = User::role('Master User')->first();
        $ticketComment = TicketComment::create([
            'tickets_id' => $data['tickets_id'],
            'users_id' => $auth_user,
            'comment' => $data['comment'],
        ]);
        $ticket = Ticket::where('id', $data['tickets_id'])->first();
        // dd($ticket);
        $ticketComment['ticket_no'] = $ticket->ticket_no;
        $ticketComment['notifi_title'] = 'Ticket Comment';
        // dd($ticketComment);
        $user->notify(new TicketCommentNotification($ticketComment));

        \LogActivity::addToLog('Comment added to the ticket, ticket_no'.$ticket['ticket_no']);
        \LogActivity::addToLog('Comment added to the ticket, Notification sent to user'.$ticket['ticket_no'].' Username:'.$user->name);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketComment  $ticketComment
     * @return \Illuminate\Http\Response
     */
    public function show(TicketComment $ticketComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TicketComment  $ticketComment
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketComment $ticketComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TicketComment  $ticketComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $auth_user = Auth::id();
        // $data = $request->validated();
        TicketComment::where('id', $request->id)->update([
            'comment' => $request->comment
        ]);
        $ticketComment = TicketComment::whereId($request->id)->with('tickets')->first();
        \LogActivity::addToLog('Comment Updated in the ticket: '.$ticketComment->tickets['ticket_no']);
            return response()->json($ticketComment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketComment  $ticketComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ticketComment = TicketComment::whereId($request->id)->delete();
        $ticket = Ticket::whereId($request->ticket_id)->first();

        \LogActivity::addToLog('Comment deleted from the ticket: '.$ticket['ticket_no']);
            return response()->json('success');

    }
}
