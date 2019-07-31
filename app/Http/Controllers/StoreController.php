<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cookie;
use Auth;
use App\Models\Group;
use App\Models\Feature;
use App\Models\Product;
use App\Models\ProductFeatures;
use App\Models\Review;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Spec\Spec;
use App\Models\Spec\SpecHeader;
use App\Http\Requests\AddReview;
use function Ybazli\Faker\string;
use App\Models\ProductVariation;
use App\Models\Brand;
use App\Models\Color;
use Illuminate\Support\Facades\Validator;
use App\Models\Grouping\Category;
use App\Http\Resources\CartItemCollection;
use App\Models\Currency\Currency;
use App\Models\Grouping\Subject;

class StoreController extends Controller
{
    public function index()
    {
        // $this -> restore_cart();
        // $this->move_cart_items();

        return view('front.index', [
            // 'top_products'  => ProductVariation::getTops(18, true),
            // 'cart_products' => $this -> Get_Cart_items(),
            // 'brands'        => Brand::all(),
            'page_name'     => 'main',
            // 'offers' => [
            //     'the_most'    => ProductVariation::productOffers('the_most'),
            //     'mostـurgent' => ProductVariation::productOffers('mostـurgent'),
            // ],
            'options' => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    public function store($query = null)
    {
        // $data = Validator::make($_GET, [
        //     'brand.*'    => [ 'nullable', 'integer', 'exists:brands,id' ],
        //     'color.*'    => [ 'nullable', 'integer', 'exists:colors,id' ],
        //     'price_from' => [ 'nullable', 'integer', 'min:0', 'max:10000', 'lt:price_to' ],
        //     'price_to'   => [ 'nullable', 'integer', 'min:0', 'max:10000', 'gt:price_from' ],
        //     'orderby'    => [ 'nullable' , 'in:newst,oldest,most_expensive,cheapest']
        // ])->validate();

        return view('store.shop', [
            // 'currencies'      => Currency::productCard($query, array_merge([ 'more' => true ], $data)),
            'currencies'      => Currency::productCard(),
            // 'data'          => $data,
            // 'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'groups'        => $this -> Get_sub_groups(),
            'subjects'      => Subject::all(),
            // 'cart_products' => $this -> Get_Cart_items(),
            // 'brands'        => Brand::all(),
            // 'colors'        => Color::all(),
            // 'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => $query ? "جستجو برای $query" : 'محصولات',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    public function category(Category $category)
    {
        return view('store.category  ', [
            'category'      => $category->load('childs'),
            'category_pros' => Currency::productCard(null, [ 'category' => $category->id ]),
            'products'      => Currency::productCard(),
            'breadcrumb'    => $this->breadcrumb($category),
            // 'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'groups'        => $this -> Get_sub_groups(),
            // 'cart_products' => $this -> Get_Cart_items(),
            // 'brands'        => Brand::all(),
            // 'colors'        => Color::all(),
            // 'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => 'گروه ' . $category->title,
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }
    
    public function currency(Currency $currency)
    {
        return view('store.single-product', [
            'product'       => Currency::productInfo($currency, ['reviews' => true]),
            'relateds'      => Currency::related_products($currency),
            'currencies'    => Currency::productCard(),
            // 'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            'breadcrumb'    => $this->breadcrumb($currency->category),
            'groups'        => $this -> Get_sub_groups(),
            // 'cart_products' => $this -> Get_Cart_items(),
            // 'brands'        => Brand::all(),
            // 'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => $currency->title,
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    // public function add_review(AddReview $request, Currency $currency)
    // {
    //     auth()->user()->reviews()->create(
    //         array_merge( $request->all(), [ 'currency_id' => $currency->id ])
    //     );

    //     return redirect()->back()->with('message', 'نظر شما با موفقیت ثبت شد .');
    // }
}
