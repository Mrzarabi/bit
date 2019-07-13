<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;


class Ticket extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    /****************************************
     **             Attributes
     ***************************************/
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'title',
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

    /**
     * The attributes that should delete all relation with this model.
     *
     * @var array
     */
    protected $cascadeDeletes = [
        'ticketmessages'
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
