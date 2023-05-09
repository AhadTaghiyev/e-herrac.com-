<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auction;
use App\Http\Requests\AuctionRequest;

class AuctionController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:auction-list|auction-create|auction-edit|auction-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:auction-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:auction-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:auction-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auctions = Auction::all();
        return view('admin.auctions.index', compact('auctions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.auctions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AuctionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuctionRequest $request)
    {
        $auction = new Auction;
        $auction->date = $request->input('date');
        $auction->time = $request->input('time');
        $auction->is_repeat = $request->input('is_repeat');
        $auction->is_active = $request->input('is_active');
        $auction->save();
        return redirect()->route('admin.auctions.index')->with('success', 'Auction added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function show(Auction $auction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function edit(Auction $auction)
    {
        return view('admin.auctions.edit', compact('auction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AuctionRequest  $request
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function update(AuctionRequest $request, Auction $auction)
    {
        $auction->date = $request->input('date');
        $auction->time = $request->input('time');
        $auction->is_repeat = $request->input('is_repeat');
        $auction->is_active = $request->input('is_active');
        $auction->save();
        return redirect()->route('admin.auctions.index')->with('success', 'Auction updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auction  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction $auction)
    {
        $auction->delete();
        return redirect()->route('admin.auctions.index')->with('success', 'Auction deleted.');
    }

}
