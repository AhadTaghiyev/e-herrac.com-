<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Auction;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category)
    {
        $breadcrumb = [];
        $breadcrumb[] = ['title' => 'Ana səhifə', 'url' => route('home'), 'current' => false];
        foreach($category->ancestors as $ancestor) {
            $breadcrumb[] = ['title' => $ancestor->name, 'url' => route('category', $ancestor->path), 'current' => false];
        }
        $breadcrumb[] = ['title' => $category->name, 'url' => route('category', $category->path), 'current' => true];
        $data = ['breadcrumb' => $breadcrumb];
        $auctions = Auction::where('is_active', 1)->get();
        $data['auctions']['new'] = $auctions->where('is_repeat', 0);
        $data['auctions']['repeated'] = $auctions->where('is_repeat', 1);
        $data['featured_advetisements'] = Advertisement::where('is_active', 1)->where('is_featured', 1)->orderBy('created_at')->take(5)->get();
        $advertisements = $category->advertisements()->paginate();
        return view('site.category', compact('category', 'advertisements', 'breadcrumb', 'data'));
    }


}
