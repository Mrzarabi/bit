<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use App\User;
use App\Models\Ticket\TicketMessage;
use App\Http\Requests\V1\Ticket\TicketMessageRequest;

class Ticketcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TicketMessage $ticket_message, Ticket $ticket, User $user)
    {
        return view('panel.tickets', [
            'tickets' => Ticket::orderBy('created_at', 'DESC')->paginate(20),
            'ticket_message' => $ticket_message,
            'user'  => $user,
            'page_name' => 'ticket',
            'page_title' => 'تیکت',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ticket $ticket)
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Ticket\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function store(TicketMessageRequest $request)
    {
        auth()->user()->ticketmessages()->create(array_merge($request->all(), [
            'ticket_id' => $request->ticket_id,
        ]));

        return redirect()->back()->with('message', "مقاله  {$request->title} با موفقیت ثبت شد");
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request\V1\User\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models/Ticket/Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $ticket->load([
            'ticketmessages' => function($query) {
                return $query->orderBy('created_at', 'DESC')->paginate(10);
            },
            'ticketmessages.user'
        ]);

        return view('panel.ticket', [
            'ticket' => $ticket,
            'page_name' => 'show-messages-ticket',
            'page_title' => 'مشاهده پیام های تیکت',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketMessage $ticket_message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->load('user');
        $ticket->delete();
        $ticket->update(['is_close' => true]);

        return redirect(route('ticket.index'))->with('message',  "تیکت کاربر {$ticket->user->first_name} {$ticket->user->last_name} با موفقیت حذف شد");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function is_close(Ticket $ticket)
    {
        $ticket->update([
            'is_close' => true,
            ]);

        return redirect(route('ticket.index'))->with('message',  "تیکت کاربر {$ticket->user->first_name} {$ticket->user->last_name} با موفقیت حذف شد");
    }

     /**
     * Show the filtered tickets from storage.
     *
     * @param  String  $query
     * @return \Illuminate\Http\Response
     */
    public function search($query = '')
    {
        return view('panel.tickets', [
            'tickets' => Ticket::latest()->where('title', 'like', "%$query%")->paginate(10),
            'page_name' => 'ticket',
            'page_title' => 'تیکت',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }
}
