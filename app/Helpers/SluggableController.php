<?php

namespace App\Helpers;

trait SluggableController
{
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
                
            return $this->model::with( $this->relations )->whereSlug($data)->firstOrFail();
        }
        else
            return $this->model::whereSlug($data)->firstOrFail();
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
        return $this->model::whereSlug($data)->firstOrFail();
    }
}