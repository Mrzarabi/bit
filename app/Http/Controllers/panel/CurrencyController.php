<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency\Currency;
use App\Http\Requests\V1\Currency\CurrencyRequest;
use App\Models\Grouping\Category;
use Illuminate\Support\Facades\Input;
use App\Models\Spec\SpecData;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.currency',
        [
            'currencies' => Currency::orderBy('created_at', 'DESC')->paginate(10),
            'page_name' => 'currency',
            'page_title' => 'محصولات',
            'options'=> $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.add-currency', [
            'groups' => Category::all(),
            'page_name' => 'add_currency',
            'page_title' => 'ثبت محصول',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currency = auth()->user()->currencies()->create( array_merge( $request->all(), [
            'category_id' => $request->parent,
            'photo' => isset($request->photo) ? $this->upload_image( Input::file('photo') ) : null,
        ] ));

        // return $request;

        return redirect(route('currency.index'))->with('message', 'محصول '.$currency->title.' با موفقیت ثبت شد .');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        return view('panel.show-reviews-single-currency', [
            'currency' => $currency,
            'page_name' => 'show-blog-review',
            'page_title' => 'مشاهده محصول و نظرات',
            'options' => $this->options(['site_name', 'site_logo'])
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency, Category $category)
    {
        if ( is_null($currency->spec_id) )
        {
            if ($currency->category_id) 
            {
                $spec = Category::findOrFail($currency->category_id)->specs()->first();
                if($currency->category->parent)
                {
                    if ($spec == [])
                        $spec = Category::findOrFail($currency->category_id)->parent_group()->first()->specs()->first();
                }

                if ( $spec != [] )
                    $currency->update([ 'spec_id' => $spec->id ]);
            }
        }

        return view('panel.add-currency', [
            'currency'    => Currency::productInfo($currency),
            'groups'      => Category::all(),
            // 'child'       => Category::child(),
            'page_name'   => 'currencies',
            'page_title'  => 'ویرایش محصول ',
            'options'     => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, Currency $currency)
    {
        if ($request->hasFile('photo'))
        {
            $photo = $this->upload_image( Input::file('photo') );
            
            if ( file_exists( public_path($currency->photo) ) )
                unlink( public_path($currency->photo) );
        }
        else
        {
            $photo = $currency->photo;
        }

        
        // return $request;
        // return $request->parent;        
        $currency->update( array_merge($request->all(), [
            'photo' => $photo,
            'category_id' => $request->parent,
        ]));


        if ( $request->specs )
        {
            foreach ( $request->specs as $key => $item )
            {
                if ( isset( $item['id'] ) )
                {
                    SpecData::findOrFail($item['id'])->update(array_merge($item, [
                        'data' => (gettype($item['data']) == 'array') ? implode(',', $item['data']) : $item['data']
                    ]));
                }
                elseif ( isset($item['data']) && $item['data'] )
                {   
                    SpecRow::find($key)->specData()->create(array_merge($item, [
                        'currency_id' => $currency->id,
                        'data' => (gettype($item['data']) == 'array') ? implode(',', $item['data']) : $item['data'] 
                    ]));
                }
            }
        }

        return redirect(route('currency.index'))->with('message', 'محصول '.$currency->title.' با موفقیت بروزرسانی شد .');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
        return redirect( route('currency.index') )->with('message', 'محصول '.$currency->title.' با موفقیت حذف شد .');
    }

    /**
     * Show the filtered currencies from storage.
     *
     * @param  String  $query
     * @return \Illuminate\Http\Response
     */
    public function search($query = '')
    {
        return view('panel.currency', [
            'currencies' => Currency::latest()->where('title', 'like', "%$query%")->paginate(10),
            'page_name' => 'currencies',
            // 'query' => $query,
            'page_title' => 'جستجوی محصولات ',
            'options'=> $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Upload the image and insert watermark on it
     *
     * @param File $images
     * @return Array
     */
    public function upload($input)
    {
        if ($input != [])
        {
            $images = [];
            $watermark = $this->options(['watermark'])['watermark'];
            foreach (Input::file('photo') as $photo)
            {
                $images[] = $this->upload_image($photo, 500, public_path('logo/' . $watermark) );
            }
            return $images;
        }
        else
        {
            return [];
        }
    }
}
