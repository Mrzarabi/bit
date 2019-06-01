<?php

namespace App\Models\Opinion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article\Article;

class Comment extends Model
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
        'article_id',
        'parent_id',
        'messages',
        'is_accept'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_accept' => 'boolean',
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
     * Get the article of the comment.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Get the user of the comment.
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * This function for answer's comments.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
