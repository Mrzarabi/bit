<?php

namespace App\Http\Controllers\panel;

use App\Models\Article\Article;
use App\Http\Requests\V1\Article\ArticleRequest;
use App\Http\Controllers\MainController;
use App\Helpers\SluggableController;
use App\Helpers\HasUser;

class ArticleController extends MainController
{
    use SluggableController, HasUser;

    /**
     * Instantiate a new MainController instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->more_relations = [
            'comments' => function($query) {
                return $query->orderBy('created_at', 'DESC')->paginate(10);
            },
            'comments.user',
            'comments.replies',
            'comments.replies.user'
        ];
    }

    /**
     * Type of this controller for use in messages
     *
     * @var string
     */
    protected $type = 'article';

    /**
     * The model of this controller
     *
     * @var Model
     */
    protected $model = Article::class;

    /**
     * The request class for this controller
     *
     * @var Model
     */
    protected $request = ArticleRequest::class;

    /**
     * The relation of the controller to get when accesing data from DB
     *
     * @var array
     */
    protected $relations = [
        'subject',
        'user:id:first_name,last_name'
    ];

    protected $more_relations;

    /**
     * Name of the views that need by this controller
     *
     * @var string
     */
    protected $views = [
        'index' => 'panel.articles',
        'show'  => 'panel.show-comments',
        'form'  => 'panel.add-article',
    ];

    /**
     * Name of the field that should upload an logo from that
     *
     * @var string
     */
    protected $image_field = 'image';

    /**
     * Name of the relation method of the User model to this model
     *
     * @var string
     */
    protected $rel_from_user = 'articles';

    /**
     * Check the request to it'has image or not,
     * then create a data with appropirate method
     *
     * @param Request $request
     * @return void
     */
    public function storeData($request)
    {
        if ( isset($this->image_field) && $request->hasFile( $this->image_field ) )
        {
            $tags = explode(" ", $request->tags);

            $model = $this->createNewModel(
                $this->getRequest( $this->requestWithImage($request, $this->image_field) )
            );

            $model->tag($tags);
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
        $tags = explode(" ", $request->tags);
        if ( isset($this->image_field) && $request->hasFile( $this->image_field ) )
        {

            $data->update(
                $this->getRequest( $this->getRequest( $this->requestWithImage($request, $this->image_field, $data) ) )
            );
            $data->retag($tags);
        } else {

            $data->update( $this->getRequest( $request ) );
            $data->retag($tags);
        }

        return $data;
    }
}
