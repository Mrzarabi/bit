<?php

namespace App\Models\Bank;

use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
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
        'bank_name',
        'bank_card',
        'code',
        'image_benk_card',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'image_benk_card'  => 'array',
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
}
