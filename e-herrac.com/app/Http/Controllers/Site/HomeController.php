<?php

namespace App\Http\Controllers\Site;

use App\Models\Advertisement;
use App\Models\Auction;
use App\Models\Category;
use App\Models\Client;
use App\Models\Coverage;
use App\Models\News;
use App\Models\Offer;
use App\Models\Page;
use App\Models\Project;
use App\Models\Service;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
       
        $data = [];
        $data['slides'] = Slide::where('is_active', 1)->get();
        $data['categories'] = Category::where('is_active', 1)->get()->toTree();
        $auctions = Auction::where('is_active', 1)->get();
        $data['auctions']['new'] = $auctions->where('is_repeat', 0);
        $data['auctions']['repeated'] = $auctions->where('is_repeat', 1);

        $data['advertisements'] = Advertisement::where('is_active', 1)->orderBy('created_at')->paginate(9);

        $data['featured_advetisements'] = Advertisement::where('is_active', 1)->where('is_featured', 1)->orderBy('created_at')->take(5)->get();


        return view('site.home', compact('data'));
    }
}
