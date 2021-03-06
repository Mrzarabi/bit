<?php

namespace App\Models\Spec;

use Illuminate\Database\Eloquent\Model;
use App\Models\Currency\Currency;

class SpecData extends Model
{

    /****************************************
     **         Name of the Database
     ***************************************/

    protected $table = 'spec_data';

    /****************************************
     **             Attributes
     ***************************************/
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currency_id',
        'data',
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
     * Get the specificationRow of the specificatoinData.
     */
    public function specRow()
    {
        return $this->belongsTo(SpecRow::class, 'spec_row_id');
    }
    
    /**
     * Get the currency of the specificationData.
     */
    public function currencies()
    {
        return $this->belongsTo(Currency::class);
    }
}
