<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advertisement;
use App\Models\Category;
use App\Http\Requests\AdvertisementRequest;
use App\Models\Auction;
use App\Models\Region;

class AdvertisementController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:advertisement-list|advertisement-create|advertisement-edit|advertisement-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:advertisement-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:advertisement-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:advertisement-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements = Advertisement::all();
        return view('admin.advertisements.index', compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get()->toTree();
        $regions = Region::where('is_active', true)->get();
        $auctions = Auction::where('is_active', true)->get();
        $traverse = function ($categories, $prefix = '', $default = null) use (&$traverse) {
            foreach ($categories as $category) {
                echo '<option value="'.$category->id.'" '.($default === (string)$category->id ? ' selected' : '').'>'. PHP_EOL.$prefix.' '.$category->name .'</option>';
                $traverse($category->children, $prefix.'-', $default);
            }
        };
        return view('admin.advertisements.create', compact('categories', 'regions', 'auctions', 'traverse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AdvertisementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementRequest $request)
    {
        $advertisement = new Advertisement();
        $advertisement->category_id = $request->input('category_id');
        $advertisement->region_id = $request->input('region_id');
        $advertisement->auction_id = $request->input('auction_id');
        $advertisement->name = $request->input('name');
        $advertisement->content = $request->input('content');
        $advertisement->notes = $request->input('notes');
        $advertisement->price = $request->input('price');
        $advertisement->currency = $request->input('currency');
        $advertisement->is_featured = $request->input('is_featured', false);
        $advertisement->is_active = $request->input('is_active');
        $advertisement->save();
        processSingleMedia($advertisement, 'image', 'image', $request);
        processMultipleMedia($advertisement, 'images', 'images', $request);
        return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        $categories = Category::where('is_active', true)->get()->toTree();
        $regions = Region::where('is_active', true)->get();
        $auctions = Auction::where('is_active', true)->get();
        $traverse = function ($categories, $prefix = '', $default = null) use (&$traverse) {
            foreach ($categories as $category) {
                echo '<option value="'.$category->id.'" '.($default === (string)$category->id ? ' selected' : '').'>'. PHP_EOL.$prefix.' '.$category->name .'</option>';
                $traverse($category->children, $prefix.'-', $default);
            }
        };
        return view('admin.advertisements.edit', compact('advertisement', 'categories', 'regions', 'auctions', 'traverse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AdvertisementRequest  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisementRequest $request, Advertisement $advertisement)
    {
        $advertisement->category_id = $request->input('category_id');
        $advertisement->region_id = $request->input('region_id');
        $advertisement->auction_id = $request->input('auction_id');
        $advertisement->name = $request->input('name');
        $advertisement->content = $request->input('content');
        $advertisement->notes = $request->input('notes');
        $advertisement->price = $request->input('price');
        $advertisement->currency = $request->input('currency');
        $advertisement->is_featured = $request->input('is_featured', false);
        $advertisement->is_active = $request->input('is_active');
        $advertisement->save();
        processSingleMedia($advertisement, 'image', 'image', $request);
        processMultipleMedia($advertisement, 'images', 'images', $request);
        return redirect()->route('admin.advertisements.index')->with('success', 'Equipment updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement deleted.');
    }

}
