<?php

namespace App\Models\Opinion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Currency\Currency;

class Review extends Model
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
        // 'currency_id',
        // 'ranks',
        // 'advantages',
        // 'disadvantages',
        // 'message',
        // 'is_accept'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'is_accept'              => 'boolean',
        // 'ranks'                  => 'array',
        // 'advantages'             => 'array',
        // 'disadvantages'          => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        // 'deleted_at'
    ];

    /****************************************
     **              Relations
     ***************************************/

    /**
     * Get the currency of the review.
     */
    // public function currency()
    // {
    //     return $this->belongsTo(Currency::class);
    // }

    /**
     * Get the user of the review.
     */
    // public function user()
    // {
    //     return $this->belongsTo(\App\User::class);
    // }
}
