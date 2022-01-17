<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Comment;
use App\Models\Knihy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    public function show(Comment $comment){
        return view('comment.edit',['comment' => $comment]);
    }

    public function index() {
        dd("coment index");
        $coments = Comment::latest()->with(['user', 'likes'])->paginate(10);
        
        return view('knihy.knihy', [
            'knihy' => $coments
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required',
            'rating' => 'required'
        ]);  

        $request->user()->comments()->create([
            'comment' => $request->body,
            'book_id' => $request->book,
            'rating' => $request->rating,
        ]);

        if($request->user()->comments()->where('book_id', $request->book)->count())
        throw ValidationException::withMessages(['msg' => ['not unique']]);

        return back();
    }

    public function destroy(Comment $comment){
        $this->authorize('delete', $comment);
        $comment->delete();
        return back();
    }

    public function edit(Request $request,Comment $comment){
        $this->validate($request, [
            'body' => 'required'
        ]); 

        
        if($comment->comment === $request->body){
            throw ValidationException::withMessages(['body' => 'The body field wasn\'t changed']);
        };

        $this->authorize('update', $comment);
        $comment->update(array('comment'=>$request->body));
        
        return redirect('books/'.$comment->book_id);
    }
}
