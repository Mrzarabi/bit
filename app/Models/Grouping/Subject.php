<?php

namespace App\Models\Grouping;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article\Article;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Subject extends Model
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
        'title',
        'logo',
        'description',
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
            'subjects.title' => 10,
            'subjects.description' => 8,
        ],
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
