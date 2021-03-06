<?php

namespace App;

// use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Models\Article\Article;
use App\Models\Currency\Currency;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketMessage;
use App\Models\Bank\BankCard;
use App\Models\Opinion\Comment;
use App\Models\Opinion\Review;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Laratrust\Traits\LaratrustUserTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Models\User\Purchase;
use App\Notifications\MailResetPasswordToken;

class User extends Authenticatable
{
    use Notifiable, CanResetPassword, SoftDeletes, CascadeSoftDeletes, LaratrustUserTrait;
    use SearchableTrait;


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
        'last_name',
        'national_code',
        'phone_number',
        'birthday',
        'address',
        'email',
        'avatar',
        'can_buy',
        'password',
        'password_confirmation',
        'image_national_code',
        'identify_certificate',
        'image_bill',
        'image_selfie_national_code',
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'accept_image_national_code' => 'boolean',
        'accept_identify_certificate' => 'boolean',
        'accept_image_bills' => 'boolean',
        'accept_image_selfie_national_code' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should delete all relation with this model.
     *
     * @var array
     */
    protected $cascadeDeletes = [
        'articles',
        'comments',
        'tickets',
        'ticketMessages',
        'currencies',
        'bankCard',
        'purchases'
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
            'users.first_name' => 10,
            'users.last_name'  => 9,
            'users.national_code' => 8,
            'users.phone_number'  => 7,
        ],
    ];


    /**
     * Send a password reset email to the user
     */
    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new MailResetPasswordToken($token));
    // }

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
     * Get all of the purchases for the user.
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
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
    // public function reviews()
    // {
    //     return $this->hasMany(Review::class);
    // }

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
