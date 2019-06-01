<?php

namespace App\Models\Currency;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Spec\Spec;
use App\Models\Grouping\Category;
use App\Models\Spec\SpecData;
use App\Models\Opinion\Review;

class Currency extends Model
{
    use Sluggable;
    /****************************************
     **             Attributes
     ***************************************/
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'price',
        'inventory',
        'image'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'image'  => 'array',
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
     * Get the user of the currency.
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Get the category of the currency.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the specificationData for the currency.
     */
    public function specData()
    {
        return $this->hasMany(SpecData::class);
    }

    /**
     * Get all of the reviews for the currency.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /****************************************
     **           Better Manage
     ***************************************/

     /**
     * Return the pass for this model's URL.
     *
     * @return array
     */
    public function path()
    {
        return "/article/".$this->slug;
    } 

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
