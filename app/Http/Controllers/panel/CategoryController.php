<?php

namespace App\Http\Controllers\panel;

use App\Models\Grouping\Category;
use App\Http\Requests\V1\Grouping\CategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the Categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.category', [
            'categories' => Category::first_levels(),
            'page_name' => 'category',
            'page_title' => 'گروه بندی محصولات',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  \Illuminate\Http\Request\V1\Grouping\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create(array_merge($request->all(), [
            'logo' => $request->hasFile('logo') ? $this->upload_image( Input::file('logo') ) : null,
        ]));
        // return $request->logo;
        return redirect()->back()->with('message', 'گروه '.$request->title.' با موفقیت ثبت شد .');
    }

    /**
     * Display the specified Category.
     *
     * @param  \App\models\Grouping\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('panel.category', [
            'categories' => $category->childs()->get(),
            'id' => $category->id,
            'category' => $category,
            'breadcrumb' => $this -> breadcrumb($category),
            'page_name' => 'group',
            'page_title' => 'گروه های زیرمجموعه ' . $category->title,
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  \App\models\Grouping\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('panel.category', [
            'categories' => $category->childs()->get(),
            'category' => $category,
            'id' => $category->id,
            'breadcrumb' => $this -> breadcrumb($category),
            'page_name' => 'category',
            'page_title' => 'ویرایش گروه ' . $category->title,
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  \Illuminate\Http\Request\V1\Grouping\CategoryRequest  $request
     * @param  \App\models\Grouping\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if ($request->hasFile('logo'))
        {
            $logo = $this->upload_image( Input::file('logo') );
            
            if ( file_exists( public_path($category->logo) ) )
                unlink( public_path($category->logo) );
        }
        else
        {
            $logo = $category->logo;
        }
                
        $category->update(array_merge($request -> all(), [
            'logo' => $logo
        ]));
        return redirect(route('category.index'))->with('message', 'گروه '.$request->title.' با موفقیت بروز رسانی شد .');
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  \App\models\Grouping\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect( route('category.index') )->with('message', 'گروه '.$category->title.' با موفقیت حذف شد .');
    }

    /**
     * return a sub child of specified category in json
     *
     * @param Integer $id
     * @return JSON
     */
    public function sub($id)
    {
        return json_encode( Category::select('id', 'title')->where('parent', $id)->get() );
    }
}
