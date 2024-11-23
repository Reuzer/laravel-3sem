<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;
class CommentController extends Controller
{
    public function store(Request $request){
        $request->validate([
            "name"=>'required|min:4',
            "desc"=>'required|max:256'
        ]);

        $comment = new Comment;
        $comment->name = $request->name;
        $comment->desc = $request->desc;
        $comment->article_id = request('article_id');
        $comment->user_id=1;
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
    }

    public function edit($id){
        $comment = Comment::findOrFail($id);
        return view('comment.update', ['comment'=>$comment]);
    }

    public function update(Request $request,Comment $comment){
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
        $comment->delete();
        return redirect()->route('articles.show', $comment->article_id)->with('status', 'Deleted');
    }
}