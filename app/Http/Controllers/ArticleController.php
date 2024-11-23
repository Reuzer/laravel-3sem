<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(6);
        return view('article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6',
            'desc' => 'required|max:256',
        ]);

        $article = new Article;
        $article->date = request('date');
        $article->name = request('name');
        $article->desc = request('desc');
        $article->user_id = auth() -> user()->id;
        $article->save();
        return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $comments = Comment::where('article_id', $article->id)->get();
        $user = User::findOrFail($article->user_id);
        return view('article.show', ['article'=>$article, 'user'=>$user, 'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('article.update', ['article'=>$article]);
    }

    public function update(Request $request, Article $article)
    {
        //
        $request->validate([
            'date'=>'date',
            'name'=>'required|min:5|max:100',
            'desc'=>'required|min:5'
        ]);
        $article->date = $request->date;
        $article->name = $request->name;
        $article->desc = $request->desc;
        $article->user_id = 1;
        if ($article->save()) return redirect('/article')->with('status','Update success');
        else return redirect()->route('article.index')->with('status','Update don`t success');
    }

    

    public function destroy(Article $article)
    {
        if ($article->delete()) return redirect('/article')->with('status','Delete success');
        else return redirect()->route('article.show', ['article'=>$article->id])->with('status','Delete don`t success');
    }
}
