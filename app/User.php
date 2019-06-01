<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Article\Article;
use App\Models\Currency\Currency;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketMessage;
use App\Models\Bank\BankCard;
use App\Models\Opinion\Comment;
use App\Models\Opinion\Review;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /****************************************
     **          Important methods
     ***************************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'second_name',
        'last_name',
        'social_link',
        'phone_number',
        'birthday',
        'address',
        'email',
        'password',
        'avatar',
        'image_social_link',
        'image_certificate',
        'image_bills',
        'image_selfie_social_link',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /****************************************
     **         Important Method
     ***************************************/

    /**
     * Full_name Mutators
     *
     * @return String
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->second_name . ' ' . $this->last_name;
    }

    /****************************************
     **              Relations
     ***************************************/

    /**
     * Get all of the articles for the user.
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get all of the comments for the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all of the reviews for the user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get all of the tickets for the user.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get all of the ticketmessages for the user.
     */
    public function ticketMessages()
    {
        return $this->hasMany(TicketMessage::class);
    }

    /**
     * Get all of the currencies for the user.
     */
    public function currencies()
    {
        return $this->hasMany(Currency::class);
    }

    /**
     * Get all of the bankCard for the user.
     */
    public function bankCard()
    {
        return $this->hasMany(BankCard::class);
    }

    /**
     * Relation to Review model
     *
     * @return Review Model
     */
    // public function reviews ()
    // {
    //     return $this->hasMany(\App\Models\Review::class);
    // }
}
