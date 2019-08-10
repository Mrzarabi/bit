<?php

namespace App\Http\Controllers\panel;

use App\Models\Grouping\Category;
use App\Http\Requests\V1\Grouping\CategoryRequest;
use App\Http\Controllers\MainController;

class CategoryController extends MainController
{
    /**
     * Type of this controller for use in messages
     *
     * @var string
     */
    protected $type = 'category';

    /**
     * The model of this controller
     *
     * @var Model
     */
    protected $model = Category::class;

    /**
     * The request class for this controller
     *
     * @var Model
     */
    protected $request = CategoryRequest::class;

    protected $more_relations = [
        'childs'
    ];

    /**
     * Name of the views that need by this controller
     *
     * @var string
     */
    protected $views = [
        'index' => 'panel.category',
    ];

    /**
     * Name of the field that should upload an logo from that
     *
     * @var string
     */
    protected $image_field = 'logo';

    /**
     * Get all data of the model,
     * used by index method controller
     *
     * @return Collection
     */
    public function getAllData()
    {
        $data = $this->model::whereNull('parent')->search( request('query') )->latest();
        
        if ( isset( $this->relations ) )
            $data->with( $this->relations );

        return $data->paginate( $this->getPerPage() );
    }
}
