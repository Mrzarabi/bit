<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
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
        'is_close',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_close'    => 'boolean',
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
     * Get the user of the ticket.
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Get all of the ticketmessages for the ticket.
     */
    public function ticketmessages()
    {
        return $this->hasMany(TicketMessage::class);
    }
}
