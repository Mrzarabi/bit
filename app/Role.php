<?php

namespace App;

use Laratrust\Models\LaratrustRole;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Role extends LaratrustRole
{
    // use SoftDeletes, CascadeSoftDeletes;

    /****************************************
     **          Important methods
     ***************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    // /**
    //  * The attributes that should be mutated to dates.
    //  *
    //  * @var array
    //  */
    // protected $dates = [
    //     'deleted_at'
    // ];

    /**
     * The attributes that should delete all relation with this model.
     *
     * @var array
     */
    // protected $cascadeDeletes = [
    //     'articles',
    //     'comments',
    //     'tickets',
    //     'ticketMessages',
    //     'currencies',
    //     'bankCard',
    // ];
}