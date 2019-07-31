<?php

namespace App\Helpers;

trait MainControllerHelper
{
    /**
     * Get the primary key of the model
     *
     * @return void
     */
    public function getPrimary()
    {
        return $this->primary_feild ?? 'id';
    }

    /**
     * Return the status title messages for delete and accept
     *
     * @param integer $result
     * @return string
     */
    public function getStatus($result)
    {
        if ( !$result )
            return 'failed';
        else
            return $result === 1 ? 'successful' : 'plural';
    }

    /**
     * Get all data of the model,
     * used by index method controller
     *
     * @return Collection
     */
    public function getAllData()
    {   
        $data = $this->model::search( request('query') )->latest();

        // if ( isset( $this->filter ) )
        //     $data = $this->model::filter( request()->all(), $this->filter );
        // else
        //     $data = $this->model::latest();
   
        if ( isset( $this->relations ) )
            $data->with( $this->relations );

        return $data->paginate( $this->getPerPage() );
    }

    /**
     * Get the dynamik per_page property of the models
     *
     * @param int|10 $max
     * @param int|100 $min
     * @return void
     */
    public function getPerPage(int $max = 100, int $min = 10)
    {
        if ( request('per_page') <= $min )
            return $min;

        elseif ( request('per_page') >= $max)
            return $max;

        else
            return request('per_page');
    }

    /**
     * Find an get a data from Database,
     * or abort 404 not found exception if can't find
     *
     * @param ID $feature
     * @return Model
     */
    public function getSingleData($data)
    {
        if ( isset( $this->relations ) )
        {
            if ( isset( $this->more_relations ) )
                $this->relations = array_merge( $this->relations, $this->more_relations );
                
            return $this->model::with( $this->relations )->findOrFail($data);
        }
        else
            return $this->model::findOrFail($data);
    }

    /**
     * Find an get a data from Database,
     * or abort 404 not found exception if can't find
     *
     * @param ID $feature
     * @return Model
     */
    public function getModel($data)
    {
        return $this->model::findOrFail($data);
    }

    /**
     * Find an get a data from Database,
     * or abort 404 not found exception if can't find
     *
     * @param ID $feature
     * @return Model
     */
    public function createNewModel($data)
    {
        return $this->model::create( $data );
    }

    /**
     * Get the portion of request class
     *
     * @param Request $request
     * @return Array $request
     */
    public function getRequest( $request)
    {
        return $request->all();
    }

    /**
     * Check the request to it'has image or not,
     * then create a data with appropirate method
     *
     * @param Request $request
     * @return void
     */
    public function storeData($request)
    {
        $model = $this->createNewModel( $this->getRequest( $request ) );

        if ( isset($this->image_field) && $request->hasFile( $this->image_field ) )
        {
            $model->addMedia( $request->file( $this->image_field ) )
                  ->toMediaCollection( $this->image_field );
        }

        return $model;
    }
    
    /**
     * Check the request to it'has image or not,
     * then update the data with appropirate method
     *
     * @param Request $request
     * @return void
     */
    public function updateData($request, $data)
    {
        $data->update( $this->getRequest( $request ) );

        if ( isset($this->image_field) && $request->hasFile( $this->image_field ) )
        {
            $data->clearMediaCollection( $this->image_field );
            
            $data->addMedia( $request->file( $this->image_field ) )
                  ->toMediaCollection( $this->image_field );
        }
        elseif ( isset($this->image_field) && $request->get('is_deleted_image') )
            $data->clearMediaCollection( $this->image_field );

        return $data;
    }

    /**
     * The function that get the model and run after the model was created
     *
     * @param Request $request
     * @param Model $data
     * @return void
     */
    public function afterCreate($request, $data)
    {
        if ( isset( $this->relations ) )
            $data->load( $this->relations );
    }
    
    /**
     * The function that get the model and run after the model was updated
     *
     * @param Request $request
     * @param Model $data
     * @return void
     */
    public function afterUpdate($request, $data)
    {
        if ( isset( $this->relations ) )
            $data->load( $this->relations );
    }
}