<?php

namespace App\Models\Spec;

use Illuminate\Database\Eloquent\Model;

class SpecHeader extends Model
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
        'description'
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
     * Get the specification of the specificationHeader.
     */
    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }

    /**
     * Get all of the specificationRows for the specificationHeader.
     */
    public function spec_rows()
    {
        return $this->hasMany(SpecRow::class);
    }

    /**
     * Get all of the specificationDatas for the specificationHeader.
     */
    public function spec_data()
    {
        return $this->hasMany(SpecData::class);
    }
}
