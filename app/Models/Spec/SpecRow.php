<?php

namespace App\Models\Spec;

use Illuminate\Database\Eloquent\Model;

class SpecRow extends Model
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
        'title',
        'label',
        'values',
        'help',
        'multiple'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'values' => 'array'
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
     * Get the specheader of the specrow.
     */
    public function specHeader ()
    {
        return $this->belongsTo(SpecHeader::class, 'spec_header_id');
    }

    /**
     * Get the specrow's specdata.
     */
    public function spec_data ()
    {
        return $this->hasOne(SpecData::class, 'spec_row_id');
    }

    /**
     * Get all of the specdatas for the spesrow.
     */
    public function specDatas ()
    {
        return $this->hasMany(SpecData::class, 'spec_row_id');
    }
}
