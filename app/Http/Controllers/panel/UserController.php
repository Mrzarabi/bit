<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\UserRequest;
use App\User;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\V1\User\AcceptUserCertificate;

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
            'users' => User::where('id', '!=', auth()->user()->id)->latest()->paginate(20),
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
     * @param  int  $id
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
     * @param  int  $id
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return view('user.index')->with('message',  "کاربر {$user->last_name} با موفقیت حذف شد");
    }

    public function accept_certificate(AcceptUserCertificate $request, User $user)
    {
        return  [
            'fuck'
        ];

        if ( !$request->status )
        {
            if ( file_exists( public_path( $user->{$request->type} ) ) )
                unlink( public_path( $user->{$request->type} ) );
        }

        // TODO
        // notify the user when accept or not it's certificates
        
        $user->update([
            "accept_{$request->type}" => $request->status
        ]);
        return 'fucl';

    }
}
