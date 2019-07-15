<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\UserRequest;
use App\User;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\V1\User\AcceptUserCertificate;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.user', [
            'users' => User::where('id', '!=', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10),
            'page_name' => 'user',
            'page_title' => 'کاربران',
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {        
        return view('panel.user-show', [
            'user' => $user,
            'page_name' => 'show-blog-comment',
            'page_title' => 'مشاهده مقاله و کامنت ها',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('panel.add-user', [
            'user' => $user,
            'page_name' => 'show-blog-comment',
            'page_title' => 'مشاهده مقاله و کامنت ها',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\V1\User\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if ($request->hasFile('avatar'))
        {
            $avatar = $this->upload_image( Input::file('avatar') );
            
            if ( file_exists( public_path($user->avatar) ) )
                unlink( public_path($user->avatar) );
        }
        else
        {
            $avatar = $user->avatar;
        }
        
        if ( $request )
        {
            unset($request['password_confirmation']);
            $request['password'] = bcrypt($request['password']);
        }

        $user->update(array_merge($request->all(), [ 'avatar' => $avatar ]));
        
        return redirect(route('user.index'))->with('message', "کاربر {$user->last_name} با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('message', "کاربر {$user->last_name} با موفقیت حذف شد");
    }

    /**
     * Accept the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request\V1\User\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function accept_certificate(AcceptUserCertificate $request, User $user)
    {
        if ( !$request->status )
        {
            if ( file_exists( public_path( $user->{$request->type} ) ) )
                unlink( public_path( $user->{$request->type} ) );
        }

        // TODO
        // notify the user when accept or not it's certificates
        
        $user->{"accept_{$request->type}"} = $request->status;
        $user->save();
        
        return view('panel.user-show', [
            'user' => $user,
            'page_name' => 'show-blog-comment',
            'page_title' => 'مشاهده مقاله و کامنت ها',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the filtered users from storage.
     *
     * @param  String  $query
     * @return \Illuminate\Http\Response
     */
    public function search($query = '')
    {
        return view('panel.user', [
            'users' => User::latest()->where('first_name', 'like', "%$query%")->paginate(10),
            'page_name' => 'user',
            'page_title' => 'کاربران',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    // Create User Page
    public function createLaratrust()
    {
        return view('panel.users.role-create', [
            'roles' => Role::all(),
            'page_name' => 'role_create',
            'page_title' => 'ایجاد نقش',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }
    // Store New User
    public function storeLaratrust(UserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        $role = Role::find($request->input('role_id'));
        $user->attachRole($role);
        return redirect()->route('users.index')->with('success', "The user <strong>$user->first_name. ' ' . $user->last_name</strong> has successfully been created.");
    }
    // Delete Confirmation Page
    public function showLaratrust(User $user)
    {
        try {
            return view('admin.users.users_delete', [
                'user' => User::findOrFail($user),
                'page_name' => 'user',
                'page_title' => 'مشاهده کاربران ',
                'options' => $this->options(['site_name', 'site_logo'])
            ]);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    // Editing User Information Page
    public function editLaratrust(User $user)
    {
        try {
            $user = User::findOrFail($user);
            //$roles = Role::all();
            $roles = Role::with('permissions')->get();
            $permissions = Permission::all();
            $params = [
                'title' => 'Edit User',
                'user' => $user,
                'roles' => $roles,
                'permissions' => $permissions,
            ];
            return view('admin.users.users_edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    // Update User Information to DB
    public function updateLaratrust(UserRequest $request, User $user)
    {
        try {
            $user = User::findOrFail($user);

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->save();
            // Update role of the user
            $roles = $user->roles;
            foreach ($roles as $key => $value) {
                $user->detachRole($value);
            }
            $role = Role::find($request->input('role_id'));
            $user->attachRole($role);
            // Update permission of the user
            //$permission = Permission::find($request->input('permission_id'));
            //$user->attachPermission($permission);
            return redirect()->route('users.index')->with('success', "The user <strong>$user->last_name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    // Remove User from DB with detaching Role
    public function destroyLaratrust(User $user)
    {
        try {
            $user = User::findOrFail($user);
            // Detach from Role
            $roles = $user->roles;
            foreach ($roles as $key => $value) {
                $user->detachRole($value);
            }
            $user->delete();
            return redirect()->route('users.index')->with('success', "The user <strong>$user->name</strong> has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
