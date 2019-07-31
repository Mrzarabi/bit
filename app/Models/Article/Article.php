<?php

namespace App\Models\Article;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grouping\Subject;
use App\Models\Opinion\Comment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\Helpers\MediaConversionsTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Article extends Model implements HasMedia
{
    use Sluggable, SoftDeletes, CascadeSoftDeletes, SearchableTrait;
    use HasMediaTrait, MediaConversionsTrait;
    
    /****************************************
     **             Attributes
     ***************************************/
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'title',
        'slug',
        'description',
        'body',
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
            'articles.title' => 10,
            'articles.description' => 8,
            'subjects.title' => 3,
        ],
        'joins' => [
            'subjects' => ['subjects.id','articles.subject_id'],
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
        'comments'
    ];

    /****************************************
     **              Relations
     ***************************************/

    /**
     * Get the media field of the model
     */
    public function image()
    {
        return $this->morphMany(config('medialibrary.media_model'), 'model');
    }
    
    /**
     * Get the user of the article.
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Get the subject of the article.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the all comments of the article.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->where('parent_id', null);
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
