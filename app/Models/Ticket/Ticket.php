<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Ticket extends Model
{
    use SoftDeletes, CascadeSoftDeletes, SearchableTrait;

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


    /**
     * Searchable rules.
     *
     * Columns and their priority in search results.
     * Columns with higher values are more important.
     * Columns with equal values have equal importance.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'tickets.title' => 10,
            'tickets.id' => 9,
            'user.fist_name' . ' ' . 'user.last_name' => 8,
        ],
        'joins' => [
            'user' => ['user.id', 'tickets.user_id'],
        ],
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
