<?php

namespace App\Models\Grouping;

use Illuminate\Database\Eloquent\Model;
use App\Models\Spec\Spec;
use App\Models\Currency\Currency;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Category extends Model
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
        'parent',
        'title',
        'logo',
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
            'categories.title' => 10,
            'categories.description' => 8,
        ],
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
        'currencies',
        'childs',
        'specs'
    ];


    /****************************************
     **              Relations
     ***************************************/

    /**
     * Get the all category parent.
     */
    public function parent_group()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    /**
     * Get the all category child.
     */
    public function childs()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    /**
     * Get all of the currencies for the category.
     */
    public function currencies() 
    {
        return $this->hasMany(Currency::class);
    }

    /**
     * Get all of the specs for the category.
     */
    public function specs()
    {
        return $this->hasMany(Spec::class);
    }
}
