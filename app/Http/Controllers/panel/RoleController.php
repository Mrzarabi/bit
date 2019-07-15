<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\V1\User\RoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.users.role-index', [
            'roles' => Role::all(),
            'page_name' => 'role',
            'page_title' => 'نقش',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.users.role-create', [
            'permissions' => Permission::all(),
            'page_name' => 'add_role',
            'page_title' => 'ایجاد نقش',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
        ]);
     
        return redirect()->route('role.index')
            ->with('message', "نقش {$request->display_name} با موفقیت ثبت شد");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        try {
            return view('admin.roles.roles_delete', [
                'role' => Role::findOrFail($role),
                'page_name' => 'show-role',
                'page_title' => 'مشاهده نقش ها',
                'options' => $this->options(['site_name', 'site_logo'])
            ]);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            return view('panel.users.role-create', [
                'role' => Role::findOrFail($id),
                'permissions' => Permission::all(),   
                'role_permissions' => $id->permissions()->get()->pluck('id')->toArray(),
                'page_name' => 'show-role',
                'page_title' => 'مشاهده نقش ها',
                'options' => $this->options(['site_name', 'site_logo'])
            ]);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        try {
            $role = Role::findOrFail($role);
            $role->name = $request->input('name');
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');
            $role->save();
            DB::table("permission_role")->where("permission_role.role_id", $role)->delete();
            // Attach permission to role
            foreach ($request->input('permission_id') as $key => $value) {
                $role->attachPermission($value);
            }
            return redirect()->route('roles.index')->with('success', "The role <strong>$role->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            $role = Role::findOrFail($role);
            //$role->delete();
            // Force Delete
            $role->users()->sync([]); // Delete relationship data
            $role->permissions()->sync([]); // Delete relationship data
            $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete
            return redirect()->route('roles.index')->with('success', "The Role <strong>$role->name</strong> has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
