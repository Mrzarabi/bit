<?php

namespace App\Models\Grouping;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article\Article;

class Subject extends Model
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
        'title',
        'description',
        'logo'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'logo' => 'array',
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
     * Get all of the articles for the subject.
     */
    public function articles() 
    {
        return $this->hasMany(Article::class);
    }
}
