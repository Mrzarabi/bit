<?php

namespace App\Http\Controllers\panel;

use App\Models\Currency\Currency;
use App\Http\Requests\V1\Currency\CurrencyRequest;
use App\Http\Controllers\MainController;
use App\Helpers\SluggableController;
use App\Helpers\HasUser;
use App\Models\Grouping\Category;

class CurrencyController extends MainController
{
    use SluggableController, HasUser;
     /**
     * Type of this controller for use in messages
     *
     * @var string
     */
    protected $type = 'currency';

    /**
     * The model of this controller
     *
     * @var Model
     */
    protected $model = Currency::class;

    /**
     * The request class for this controller
     *
     * @var Model
     */
    protected $request = CurrencyRequest::class;

    /**
     * The relation of the controller to get when accesing data from DB
     *
     * @var array
     */
    protected $relations = [
        'category',
        'spec',
        'user:id:first_name,last_name'
    ];

    /**
     * Name of the views that need by this controller
     *
     * @var string
     */
    protected $views = [
        'index' => 'panel.currency',
        'form'  => 'panel.add-currency',
    ];

    /**
     * Name of the field that should upload an image from that
     *
     * @var string
     */
    protected $image_field = 'photo';

    /**
     * Name of the relation method of the User model to this model
     *
     * @var string
     */
    protected $rel_from_user = 'currencies';

    /**
     * Get the portion of request class
     *
     * @param Request $request
     * @return Array $request
     */
    public function getRequest( $request)
    {
        $request = gettype($request) === 'array' ? $request : $request->all();
        
        $request['category_id'] = $request['parent'] ?? null;

        return $request;
    }

    /**
     * Show the form for editing the specified data.
     *
     * @param  Model  $data
     * @return \Illuminate\Http\Response
     */
    public function edit($currency)
    {
        $this->checkPermission("update-{$this->type}");

        $currency = $this->getModel($currency);
        
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

        $currency->load([
            'spec',
            'spec.spec_headers',
            'spec.spec_headers.spec_rows',
            'spec.spec_headers.spec_rows.spec_data',
            'category'
        ]);

        return view( $this->views['form'] ?? $this->views['index'], [
            $this->type => $currency
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    // public function edit(Currency $currency)
    // {
    //     if ( is_null($currency->spec_id) )
    //     {
    //         if ($currency->category_id) 
    //         {
    //             $spec = Category::findOrFail($currency->category_id)->specs()->first();
    //             if($currency->category->parent)
    //             {
    //                 if ($spec == [])
    //                     $spec = Category::findOrFail($currency->category_id)->parent_group()->first()->specs()->first();
    //             }

    //             if ( $spec != [] )
    //                 $currency->update([ 'spec_id' => $spec->id ]);
    //         }
    //     }

    //     return view('panel.add-currency', [
    //         'groups'      => Category::all(),
    //     ]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Currency  $currency
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(CurrencyRequest $request, Currency $currency)
    // {
    //     if ($request->hasFile('photo'))
    //     {
    //         $photo = $this->upload_image( Input::file('photo') );
            
    //         if ( file_exists( public_path($currency->photo) ) )
    //             unlink( public_path($currency->photo) );
    //     }
    //     else
    //     {
    //         $photo = $currency->photo;
    //     }

        
    //     // return $request;
    //     // return $request->parent;        
    //     $currency->update( array_merge($request->all(), [
    //         'photo' => $photo,
    //         'category_id' => $request->parent,
    //     ]));


    //     if ( $request->specs )
    //     {
    //         foreach ( $request->specs as $key => $item )
    //         {
    //             if ( isset( $item['id'] ) )
    //             {
    //                 SpecData::findOrFail($item['id'])->update(array_merge($item, [
    //                     'data' => (gettype($item['data']) == 'array') ? implode(',', $item['data']) : $item['data']
    //                 ]));
    //             }
    //             elseif ( isset($item['data']) && $item['data'] )
    //             {   
    //                 SpecRow::find($key)->specData()->create(array_merge($item, [
    //                     'currency_id' => $currency->id,
    //                     'data' => (gettype($item['data']) == 'array') ? implode(',', $item['data']) : $item['data'] 
    //                 ]));
    //             }
    //         }
    //     }

    //     return redirect(route('currency.index'))->with('message', 'محصول '.$currency->title.' با موفقیت بروزرسانی شد .');    
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Currency  $currency
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Currency $currency)
    // {
    //     $currency->delete();
    //     return redirect( route('currency.index') )->with('message', 'محصول '.$currency->title.' با موفقیت حذف شد .');
    // }


    // /**
    //  * Upload the image and insert watermark on it
    //  *
    //  * @param File $images
    //  * @return Array
    //  */
    // public function upload($input)
    // {
    //     if ($input != [])
    //     {
    //         $images = [];
    //         $watermark = $this->options(['watermark'])['watermark'];
    //         foreach (Input::file('photo') as $photo)
    //         {
    //             $images[] = $this->upload_image($photo, 500, public_path('logo/' . $watermark) );
    //         }
    //         return $images;
    //     }
    //     else
    //     {
    //         return [];
    //     }
    // }
}
