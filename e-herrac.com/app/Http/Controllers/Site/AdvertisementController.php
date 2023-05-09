<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Auction;
use App\Models\Category;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Category $category, Advertisement $advertisement)
    {
        $breadcrumb = [];
        $breadcrumb[] = ['title' => 'Ana səhifə', 'url' => route('home'), 'current' => false];
        foreach($advertisement->category->ancestors as $ancestor) {
            $breadcrumb[] = ['title' => $ancestor->name, 'url' => route('category', $ancestor->path), 'current' => false];
        }
        $breadcrumb[] = ['title' => $advertisement->category->name, 'url' => route('category', $advertisement->category->path), 'current' => false];
        $breadcrumb[] = ['title' => $advertisement->name, 'url' => route('advertisement', [$advertisement->category->path, $advertisement->slug]), 'current' => true];
        $data = ['breadcrumb' => $breadcrumb];
        $auctions = Auction::where('is_active', 1)->get();
        $data['auctions']['new'] = $auctions->where('is_repeat', 0);
        $data['auctions']['repeated'] = $auctions->where('is_repeat', 1);
        $data['featured_advetisements'] = Advertisement::where('is_active', 1)->where('is_featured', 1)->orderBy('created_at')->take(5)->get();
        return view('site.advertisement', compact('advertisement', 'data'));
    }

}
