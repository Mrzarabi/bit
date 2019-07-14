<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Opinion\Comment;
use App\Models\Article\Article;
use App\Http\Requests\V1\Opinion\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Opinion\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('message', "کامنت مورد نظر با موفقیت حذف شد");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Opinion\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function is_accept(Comment $comment)
    { 
        $comment->update(['is_accept' => true]); 
        
        return redirect()->back()->with('message', "کامنت مورد نظر با موفقیت ثبت شد");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\V1\Opinion\CommentRequest  $request
     * @param  \App\Models\Opinion\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function replie_comment(CommentRequest $request, Comment $comment, Comment $reply = null)
    {
        dd($reply, $comment);

        $comment->update(['is_accept' => true]);

        if ( $reply )
            $reply->update(['is_accept' => true]);
        
        auth()->user()->comments()->create(array_merge($request->all(), [
            'parent_id'  => $request->parent_id,
            'is_accept'  => $request == true
        ]));
     
        return redirect()->back()->with('message', "کامنت مورد نظر با موفقیت تایید و ثبت شد");
    }
}
