<?php

namespace App\Models\Article;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use App\models\Grouping\Subject;
use App\Models\Opinion\Comment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Article extends Model
{
    use Sluggable, SoftDeletes, CascadeSoftDeletes;
    
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
        'image'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'array',
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
