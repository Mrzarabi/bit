<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    /****************************************
     **             Attributes
     ***************************************/
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /****************************************
     **              Relations
     ***************************************/
    
    /**
     * Get the ticket of the ticketMessage.
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    
    /**
     * Get the user of the ticketMessage.
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
