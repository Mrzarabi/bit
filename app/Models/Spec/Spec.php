<?php

namespace App\Models\Spec;

use Illuminate\Database\Eloquent\Model;
use App\Models\Grouping\Category;

class Spec extends Model
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
        'category_id'
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
     **          Important methods
     ***************************************/

    public static function compare ()
    {
        if ( !session('compare_table') || !session('compare') ) return null;

        return Static::find( session('compare_table') )
            ->load([
                'specHeaders:id,spec_id,title,description',
                'specHeaders.specRows:id,spec_header_id,title,label,values,help,multiple',
                'specHeaders.specRows.specDatas' => function ($query) {
                $query->whereIn('product_id', session( 'compare' ) );
            }
        ]);
    }

    /****************************************
     **              Relations
     ***************************************/

    /**
     * Get the category of the specification.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all of the specificationHeader for the specification.
     */
    public function specHeaders()
    {
        return $this->hasMany(SpecHeader::class);
    }
}
