<?php

namespace App\Models\Grouping;

use Illuminate\Database\Eloquent\Model;
use App\Models\Spec\Spec;
use App\Models\Currency\Currency;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Category extends Model
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
        'parent',
        'title',
        'description',
        'logo'
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

    /**
     * Return first level , or cateogries with depth == 1
     *
     * @return Collection
     */
    public static function first_levels()
    {
        return Static::select('id', 'title', 'description', 'logo')
            ->where('parent', null)->latest()->get();
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'logo' => 'array',
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
