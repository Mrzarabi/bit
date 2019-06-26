<?php

namespace App\Http\Controllers\panel;

use App\Models\Article\Article;
use App\Http\Requests\V1\Article\ArticleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Grouping\Subject;
use App\Models\Opinion\Comment;

class ArticleController extends Controller
{
    /**
     * Display a listing of the Articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.articles', [
            'articles' => Article::latest()->paginate(20),
            'page_name' => 'blog',
            'page_title' => 'مقالات',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return Article::all();
        return view('panel.add-article', [
            'subjects' => Subject::all(),
            'page_name' => 'add_blog',
            'page_title' => 'افزودن مقاله جدید',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param  \Illuminate\Http\Request\V1\Article\ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = auth()->user()->articles()->create(array_merge($request->all(), [
            'subject_id' => $request->subject_id,
            'image' => $this->upload_image( Input::file('image') )
        ]));

        return redirect()->action(
            'Panel\ArticleController@edit', ['article' => $article->slug]
        )->with('message', "مقاله {$request->title} با موفقیت ثبت شد");
    }

    /**
     * Display the specified Article.
     *
     * @param  \App\Models\Article\Article  $article
     * @return \Illuminate\Http\Response
     */ 
    public function show(Article $article, Comment $comment)
    {
        $article->load([
            'comments',
            'comments.user',
            'comments.replies',
            'comments.replies.user'
            ]);
            
        return view('panel.show-comments-single-article', [
            'article' => $article,
            'page_name' => 'show-blog-comment',
            'page_title' => 'مشاهده مقاله و کامنت ها',
            'options' => $this->options(['site_name', 'site_logo'])
        ]); 
    }

    /**
     * Show the form for editing the specified Article.
     *
     * @param  \App\Models\Article\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('panel.add-article', [
            'article' => $article,
            'subjects' => Subject::all(),
            'page_name' => 'add_blog',
            'page_title' => 'ویرایش مقاله',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param  \Illuminate\Http\Request\V1\Article\ArticleRequest  $request
     * @param  \App\Models\Article\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        if ($request->hasFile('image'))
        {
            $image = $this->upload_image( Input::file('image') );
            
            if ( file_exists( public_path($article->image) ) )
                unlink( public_path($article->image) );
        }
        else
        {
            $image = $article->image;
        }

        $article->update(array_merge($request->all(), [ 'image' => $image ]));
        
        return redirect(route('article.index'))->with('message', "مقاله {$article->title} با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified Article from storage.
     *
     * @param  \App\Models\Article\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect(route('article.index'))->with('message', "مقاله {$article->title} با موفقیت حذف شد");
    }
    
    /**
     * Show the filtered articles from storage.
     *
     * @param  String  $query
     * @return \Illuminate\Http\Response
     */
    public function search($query = '')
    {
        return view('panel.articles', [
            'articles' => Article::latest()->where('title', 'like', "%$query%")->paginate(20),
            'page_name' => 'blog',
            'page_title' => 'مقالات',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }
}
