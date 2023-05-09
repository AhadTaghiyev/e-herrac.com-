<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $posts = Post::where ( 'name', 'LIKE', '%' . $request->input('query') . '%' )->orWhere( 'content', 'LIKE', '%' . $request->input('query') . '%' )->paginate(10);
        return view('site.search', compact('posts'));
    }
}
