<?php

namespace App\Http\Controllers;

use App\Models\Knihy;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $knihy = Knihy::latest()->with(['user', 'likes'])->paginate(10);


        return view('books.show', [
            'knihy' => $knihy
        ]);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'body' => 'required'
        ]);  

        $request->user()->knihy()->create($request->only('body'));

        return back();
    }

    public function destroy(Knihy $kniha) {
        
        $this->authorize('delete', $kniha);

        $kniha->delete();
        return back();
    }
}
