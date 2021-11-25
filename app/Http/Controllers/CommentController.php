<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Knihy;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {
        $coments = Knihy::latest()->with(['user', 'likes'])->paginate(10);
        // $coments = Comment::latest()->paginate(10);
        // dd($coments);
        return view('knihy.knihy', [
            'knihy' => $coments
        ]);
    }

    public function store(Request $request) {
        
        

        $this->validate($request, [
            'body' => 'required'
        ]);  

        $request->user()->knihy()->create($request->only('body'));

        return back();
    }

    // public function destroy(Knihy $kniha) {
        
    //     $this->authorize('delete', $kniha);

    //     $kniha->delete();
    //     return back();
    // }
}
