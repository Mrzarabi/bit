<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use App\Http\Requests\V1\User\RoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the role.
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
     * Show the form for creating a new role.
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
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request\V1\User\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
        ]);

        $role->syncPermissions( $request->permission_id );
        
        return redirect()->route('role.index'
            )->with('message', "نقش {$request->display_name} با موفقیت ثبت شد");
    }

    /**
     * Display the specified role.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('admin.roles.roles_delete', [
            'role' => $role,
            'page_name' => 'show-role',
            'page_title' => 'مشاهده نقش ها',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        
        if ($role->name === 'owner') {
            return redirect()->route('role.index'
            )->with('message', " متاسفانه شما قادر به ایجاد تغییر در نقش {$role->display_name} نیستید");
        } else{

        return view('panel.users.role-create', [
            'role'  => $role,
            'permissions' => Permission::all() ,   
            'role_permissions' => $role->permissions()->get()->pluck('id' , 'name')->toArray(),
            'page_name' => 'show-role',
            'page_title' => 'مشاهده نقش ها',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
        }
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request\V1\User\RoleRequest  $request
     * @param  \App\Role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->syncPermissions( $request->permission_id );
        $role->update( $request->only('name', 'display_name', 'description') );
        
        return redirect()->route('role.index'
            )->with('message', "نقش {$request->display_name} با موفقیت به روز رسانی شد");
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  \App\Role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->name === 'owner') {
            return redirect()->route('role.index'
            )->with('message', " متاسفانه شما قادر به حذف کردن نقش {$role->display_name} نیستید");
        } else{
            $role->delete();
            return redirect()->route('role.index'
                )->with('message', "نقش {$role->display_name} با موفقیت حذف شد");
        }
    }
}
