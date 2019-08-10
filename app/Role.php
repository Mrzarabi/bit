<?php

namespace App;

use Laratrust\Models\LaratrustRole;
use App\Helpers\MediaConversionsTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Role extends LaratrustRole
{
    // use SoftDeletes, CascadeSoftDeletes;
    use  MediaConversionsTrait, SearchableTrait;

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
            'roles.name' => 10,
            'roles.display_name' => 8,
        ],
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