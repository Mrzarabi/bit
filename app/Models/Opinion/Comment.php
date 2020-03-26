<?php

namespace App\Models\Opinion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article\Article;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
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
        'title',
        'message',
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
    
    
    /**
     * The attributes that should delete all relation with this model.
     *
     * @var array
     */
    protected $cascadeDeletes = [
        'parent_id'
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
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
