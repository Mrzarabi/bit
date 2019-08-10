<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use App\User;
use App\Models\Ticket\TicketMessage;
use App\Http\Requests\V1\Ticket\TicketMessageRequest;
use App\Mail\CloseTicketMail;
use Illuminate\Support\Facades\Input;

class Ticketcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('panel.tickets', [
            'tickets_u' => Ticket::orderBy('updated_at', 'DESC')->paginate(20),
            'tickets' => Ticket::orderBy('created_at', 'DESC')->paginate(20),
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
            'image' => $this->upload_image( Input::file('image') )
        ]));

        return redirect()->back()->with('message', "تیکت  {$request->title} با موفقیت ثبت شد");
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
    public function edit(Ticket $ticket, User $user)
    {
        $ticket->load([
            'ticketmessages' => function($query) {
                return $query->orderBy('created_at', 'DESC')->paginate(10);
            },
            'ticketmessages.user'
        ]);

        return view('panel.ticket', [
            'user'  => $user,
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
        \Mail::to( $ticket->user->email )->send(new CloseTicketMail( $ticket ));
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
        $ticket->update([ 'is_close' => true ]);
        \Mail::to( $ticket->user->email )->send(new CloseTicketMail( $ticket ));

        return redirect(route('ticket.index'))->with('message',  "تیکت کاربر {$ticket->user->first_name} {$ticket->user->last_name} با موفقیت حذف شد");
    }
}
