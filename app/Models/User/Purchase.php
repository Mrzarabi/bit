<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Currency\Currency;

class Purchase extends Model
{
    
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
        'transactionId',
        'refId',
        'description',
        'purchase',
        'inventory',
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
            'purchases.refId' => 10,
            'purchases.id' => 10,
        ],
    ];

    /****************************************
     **              Relations
     ***************************************/

    /**
     * Get the users of the purchase.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the currency of the purchase.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
