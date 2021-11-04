<?php

namespace App\Http\Controllers;

use App\Models\Knihy;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function __construct() {

        $this->middleware(['auth']);
    }

    public function store(Knihy $kniha, Request $request) {

        if ($kniha->likedBy($request->user())) {
            return response (null, 409);
        }

        $kniha->likes()->create([
            'user_id' =>  $request->user()->id
        ]);

        return back();
    }

    public function destroy(Knihy $kniha, Request $request) {
        $request->user()->likes()->where ('knihy_id', $kniha->id)->delete();

        return back();
    }
}
