<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;
use App\Jobs\VeryLongJob;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function index(){
        $comments = Comment::latest()->paginate(10);
        return view('comment.index', ['comments'=>$comments]);
    }


    public function store(Request $request){
        $article = Article::findOrFail($request->article_id);
        $request->validate([
            "name"=>'required|min:4',
            "desc"=>'required|max:256'
        ]);

        $comment = new Comment;
        $comment->name = $request->name;
        $comment->desc = $request->desc;
        $comment->article_id = request('article_id');
        $comment->user_id = Auth::id();
        if($comment->save()){
            return redirect()->route('articles.show', $comment->article_id)
            ->with(
                'status',
                'Added comment'
            );
        }else{
            return redirect()->route('articles.show', $comment->article_id)
            ->with(
                'status',
                'Unable to add'
            );
        }

        if ($comment->save()){
            VeryLongJob::dispatch($comment, $article->name);
            return redirect()->route('article.show', $comment->article_id)->with('status', 'New comment send to moderation');
        } 
    }

    public function edit($id){
        $comment = Comment::findOrFail($id);
        Gate::authorize('update_comment', $comment);
        return view('comment.update', ['comment'=>$comment]);
    }

    public function update(Request $request,Comment $comment){
        Gate::authorize('update_comment', $comment);
        $request->validate([
            "name"=>'required|min:4',
            "desc"=>'required|max:256'
        ]);
        $comment->name = $request->name;
        $comment->desc = $request->desc;
        if ($comment->save()) {
            return redirect()->route('articles.show', $comment->article_id)->with('status', 'Updated');
        }else{
           return redirect()-back()->with('status', 'unable to update');
        }
    }

    public function destroy(Comment $comment) {
        Gate::authorize('update_comment', $comment);
        $comment->delete();
        return redirect()->route('articles.show', $comment->article_id)->with('status', 'Deleted');
    }
}