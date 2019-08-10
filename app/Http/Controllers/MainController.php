<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\MainControllerHelper;

abstract class MainController extends Controller
{
    use MainControllerHelper;

    /**
     * Instantiate a new MainController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the group.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->views['index'], [
            str_plural($this->type) => $this->getAllData(),

            //for single delete with fetch into view panel/components/delete
            'type' => $this->type
        ]);
    }
    
    /**
     * Show the form for creating a new data.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkPermission("create-{$this->type}");

        return view( $this->views['form'] ?? $this->views['index'] );
    }
    
    /**
     * Store a newly created group in (stor)age.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate( (new $this->request)->rules() );
        
        $this->checkPermission("create-{$this->type}");
        
        $data = $this->storeData( $request );

        if ( method_exists($this, 'afterCreate') )
            $this->afterCreate($request, $data);

        return redirect(route("{$this->type}.index"))->with('message', "با موفقیت ثبت شد");
    }
    
    /**
     * Display the specified group with it's breadcrumb.
     *
     * @param  Model $feature
     * @return ModelResource
     */
    public function show($data)
    {
        $this->checkPermission("read-{$this->type}");

        return view($this->views['show'], [
            $this->type => $this->getSingleData( $data ),
        ]);
    }

    /**
     * Show the form for editing the specified data.
     *
     * @param  Model  $data
     * @return \Illuminate\Http\Response
     */
    public function edit($data)
    {
        
        $this->checkPermission("update-{$this->type}");

        return view( $this->views['form'] ?? $this->views['index'], [
            $this->type => $this->getModel($data)
        ]);
    }

    /**
     * Get the $request & $data,
     * then Update the $data in storage.
     *
     * @param  Request  $request
     * @param  Model $data
     * @return JSON\Array
     */
    public function update(Request $request, $data)
    {
        $request->validate( (new $this->request)->rules() );
        
        $this->checkPermission("update-{$this->type}");
        
        $this->updateData( $request, $data = $this->getModel($data) );
        
        if ( method_exists($this, 'afterUpdate') )
        $this->afterUpdate( $request, $data );
        
        
        return redirect(route("{$this->type}.index"))->with('message', "با موفقیت بروزرسانی شد");
    }

    /**
     * Remove the one or multiple groups from storage.
     *
     * @param  String $features
     * @return Array\JSON
     */
    public function destroy($data)
    {
        $this->checkPermission("delete-{$this->type}");

        if ( request()->has('selected') )
            $result = $this->model::whereIn('id', request()->selected)->delete();

        else 
            $result = $this->model::where('id', $data)->delete();

        if ( $result )
            return redirect(route("{$this->type}.index"))->with('message', request()->has('selected') ? "موارد انتخاب شده با موفقیت حذف شد" : "با موفقیت حذف شد");
            
        else
            return redirect(route("{$this->type}.index"))->withErros(["متاسفانه هیچ داده ای یافت نشد"]);
    }
}