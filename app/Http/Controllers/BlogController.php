<?php

namespace App\Http\Controllers;

use App\Models\Article\Article;
use App\Models\Currency\Currency;
use App\Models\Grouping\Subject;
use App\Models\Grouping\Category;
use App\Models\Opinion\Comment;
use App\User;
use Cviebrock\EloquentTaggable\Models\Tag;

class BlogController extends Controller
{
    public function index()
    {
        return view('front.blog-default', [
            'articles'       => Article::with('user')->orderBy('created_at', 'DESC')->paginate(10),
            // 'products'      => Product::productCard(),
            // 'currencies'    => Currency::productCard(),
            // 'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            // 'groups'        => $this->Get_sub_groups(),
            'subjects'      => Subject::all(),
            // 'cart_products' => $this -> Get_Cart_items(),
            // 'brands'        => Brand::all(),
            // 'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => 'وبلاگ',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    // public function show(Article $article)
    // {
    //     return view('store.blog-single', [
    //         'article'       => $article,
    //         'currencies'    => Currency::productCard(),
    //         'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
    //         'groups'        => $this -> Get_sub_groups(),
    //         'cart_products' => $this -> Get_Cart_items(),
    //         'brands'        => Brand::all(),
    //         'top_products'  => ProductVariation::getTops(18, true),
    //         'page_title'    => 'وبلاگ',
    //         'options'       => $this->options([
    //             'slider', 'posters', 'site_name', 'site_description',
    //             'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
    //         ])
    //     ]);
    // }

    public function show(Article $article)
    {
        // $article->load([
        //     'comments' => function($query) {
        //         return $query->orderBy('created_at', 'DESC')->paginate(10);
        //     },
        //     'comments.user',
        //     'comments.replies',
        //     'comments.replies.user'
        //     ]);

        return view('front.blog-single', [
            'article'        => $article,
            'tags'           => $article->tagList,
            'last_articles'  => Article::latest()->take(5)->get(),
            // 'currencies'    => Currency::productCard(),
            // 'commnets'      => Comment::all(),
            // 'offers'        => [ 'mostـurgent' => ProductVariation::productOffers('mostـurgent') ],
            // 'groups'        => $this -> Get_sub_groups(),
            'subjects'      => Subject::orderBy('created_at', 'DESC')->paginate(10),
            // 'cart_products' => $this -> Get_Cart_items(),
            // 'brands'        => Brand::all(),
            // 'top_products'  => ProductVariation::getTops(18, true),
            'page_title'    => 'وبلاگ',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    public function showSubject(Subject $subject)
    {
        return view('front.blog-default', [
            'subject'       => $subject,
            'articles'      => $subject->articles()->orderBy('created_at', 'DESC')->paginate(10),
            'page_title'    => 'دسته بندی',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }

    public function subjectIndex(Subject $subject)
    {
        return view('store.blog', [
            'articles'      => $subject->articles()->paginate(10),
            'groups'        => $this->Get_sub_groups(),
            'subjects'      => Subject::all(),
            'page_title'    => 'دسته بندی',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }


    public function tagged($tag)
    {
        $modelTag = Tag::findByName($tag)->articles;
        return view('front.blog', [
            'articles'       => $modelTag,
            'page_title'    => 'وبلاگ',
            'options'       => $this->options([
                'slider', 'posters', 'site_name', 'site_description',
                'site_logo', 'social_link', 'dollar_cost', 'shop_address', 'shop_phone'
            ])
        ]);
    }
}
