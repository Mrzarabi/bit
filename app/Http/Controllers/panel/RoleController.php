<?php

namespace App\Http\Controllers\panel;

use App\Role;
use App\Http\Requests\V1\User\RoleRequest;
use App\Http\Controllers\MainController;
use App\Helpers\DeleteRole;

class RoleController extends MainController
{
    use DeleteRole;
    /**
     * Type of this controller for use in messages
     *
     * @var string
     */
    protected $type = 'role';

    /**
     * The model of this controller
     *
     * @var Model
     */
    protected $model = Role::class;

    /**
     * The request class for this controller
     *
     * @var Model
     */
    protected $request = RoleRequest::class;

    /**
     * The relation of the controller to get when accesing data from DB
     *
     * @var array
     */
    protected $relations = [];

    protected $more_relations;

    /**
     * Name of the views that need by this controller
     *
     * @var string
     */
    protected $views = [
        'index' => 'panel.users.role-index',
        'show'  => 'panel.users.role-create',
        'form'  => 'panel.users.role-create',
    ];

    /**
     * The function that get the model and run after the model was created
     *
     * @param Request $request
     * @param Model $data
     * @return void
     */
    public function afterCreate($request, $data)
    {
        $data->syncPermissions( $request->permission_id );
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
        $data->syncPermissions( $request->permission_id );
        if ( isset( $this->relations ) )
            $data->load( $this->relations );
    }

    /**
     * Show the form for editing the specified data.
     *
     * @param  Model  $data
     * @return \Illuminate\Http\Response
     */
    public function edit($data)
    {
        if ($this->model::findOrFail($data)->name === 'owner') {
            return redirect()->back();
        } else {
            return view( $this->views['form'] ?? $this->views['index'], [
                $this->type => $this->getModel($data)
            ]);
        }
    }
}
