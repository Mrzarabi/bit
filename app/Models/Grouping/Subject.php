<?php

namespace App\Models\Grouping;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article\Article;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Subject extends Model
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

    /**
     * The attributes that should delete all relation with this model.
     *
     * @var array
     */
    protected $cascadeDeletes = [
        'articles'
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
