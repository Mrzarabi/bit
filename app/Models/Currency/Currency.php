<?php

namespace App\Models\Currency;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Spec\Spec;
use App\Models\Grouping\Category;
use App\Models\Spec\SpecData;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Currency extends Model
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
        'category_id',
        'spec_id',
        'title',
        'slug',
        'short_description',
        'price',
        'code',
        'note',
        'status',
        'inventory',
        'photo'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'photo'  => 'array',
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
        'specData',
    ];
    /****************************************
     **              Relations
     ***************************************/
    
    /**
     * Get the user of the currency.
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * Get the category of the currency.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }

    /**
     * Get all of the specificationData for the currency.
     */
    public function specData()
    {
        return $this->hasMany(SpecData::class);
    }

    /**
     * Get all of the reviews for the currency.
     */
    // public function reviews()
    // {
    //     return $this->hasMany(Review::class);
    // }

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

    public static function productCard($query = null, $options = [])
    {
        // $feilds = ['id', 'name', 'photo', 'label', 'category_id', 'brand_id'];
        $feilds = ['id', 'title', 'photo', 'category_id'];
        if ( auth()->check() )
            // $feilds = array_merge( $feilds, [ 'code', 'status' ]);

        if ( isset($options['more']) )
            $feilds = array_merge( $feilds, [ 'advantages', 'disadvantages', 'code' ]);
        
        $relations = [
            // 'variation:id,product_id,color_id,warranty_id,price,unit,offer,offer_deadline,stock_inventory',
            // 'variation.color:id,name,value',
            // 'variation.warranty:id,title,expire',
            'category:id,title',
            // 'brand:id,title',
        ];
        // if ( isset($options['orderby']) )
        // {
        //     if ( $options['orderby'] == 'most_expensive' )
        //     {
        //         $relations['variation'] = function ($query) {
        //             $query->orderBy('price', 'asc');
        //         };
        //     }
        //     elseif ($options['orderby'] == 'cheapest')
        //     {
        //         $relations['variation'] = function ($query) {
        //             $query->orderBy('price', 'desc');
        //         };
        //     }
        // }
        $result = Static::select($feilds)->with( $relations );
        
        if ( !auth()->check() )
        {
            $result->where('status', 1);
        }

        if ( isset($options['currencies']) )
        {
            $result->whereIn('id', $options['currencies']);
        }

        if ( isset($options['category']) )
        {
            $result->where('category_id', $options['category']);
        }

        // if ($query)
        //     $result->where('name', 'like', '%'.$query.'%');

        // if ( isset($options['color']) )
        // {
        //     $result->whereHas('variations', function ($query) use ($options) {
        //         $query->whereIn('color_id', $options['color']);
        //     });
        // }

        // if ( isset($options['price_from']) )
        // {
        //     $result->whereHas('variations', function ($query) use ($options) {
        //         $query->where('price', '>', $options['price_from'] * 1000);
        //     });
        // }

        // if ( isset($options['price_to']) )
        // {
        //     $result->whereHas('variations', function ($query) use ($options) {
        //         $query->where('price', '<', $options['price_to'] * 1000);
        //     });
        // }
         
        // if ( isset($options['brand']) )
        //     $result->whereIn('brand_id', $options['brand']);
        
        // if ( isset($options['orderby']) && $options['orderby'] == 'oldest' )
        // {
        //     return $result->orderBy('created_at', 'desc')->paginate(20);
        // }
        if ( !isset($options['orderby']) || isset($options['orderby']) && $options['orderby'] == 'newest' )
        {
            $result->latest();
        } 
        // dd($options);
        return $result->paginate(10);
    }

    public static function productInfo($currency, $options = [])
    {
        $relations = [
            // Specification table full relations
            'spec:id',
            'spec.specHeaders:id,spec_id,title,description',
            'spec.specHeaders.specRows:id,spec_header_id,title,label,values,help,multiple',
            'spec.specHeaders.specRows.specData' => function ($query) use ($currency) {
                $query->where('currency_id', $currency->id);
            },
            // Product variations full relations
            // 'variations',
            // 'variations.color:id,name,value',
            // 'variations.warranty:id,title,expire',
            // 'category:id,title',
            // 'brand:id,title',
        ];
        if ( isset($options['reviews']) )
        {
            $relations[] = 'reviews';
            $relations[] = 'reviews.user:id,first_name,last_name,avatar';
            $relations['reviews'] = function ( $query ) {
                $query->orderBy('created_at', 'desc');
            };
        }
        return $currency->load($relations);
    }

    public static function related_products(Currency $currency)
    {
        return Static::select('id', 'category_id', 'title', 'photo')
            // ->with('variation:id,product_id,price,unit,offer,offer_deadline')
            ->with('currency_id,price')
            ->where('category_id', $currency->category_id)->take(4)->get();
    }
}
