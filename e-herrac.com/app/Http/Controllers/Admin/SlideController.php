<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slide;
use App\Http\Requests\SlideRequest;

class SlideController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:slide-list|slide-create|slide-edit|slide-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:slide-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:slide-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:slide-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        return view('admin.slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SlideRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlideRequest $request)
    {
        $slide = new Slide;
        $slide->title = $request->input('title');
        $slide->description = $request->input('description');
        $slide->url = $request->input('url');
        $slide->is_active = $request->input('is_active');
        $slide->save();
        processSingleMedia($slide, 'image', 'image', $request);
        return redirect()->route('admin.slides.index')->with('success', 'Slide added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slide  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SlideRequest  $request
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(SlideRequest $request, Slide $slide)
    {
        $slide->title = $request->input('title');
        $slide->description = $request->input('description');
        $slide->url = $request->input('url');
        $slide->is_active = $request->input('is_active');
        $slide->save();
        processSingleMedia($slide, 'image', 'image', $request);
        return redirect()->route('admin.slides.index')->with('success', 'Slide updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();
        return redirect()->route('admin.slides.index')->with('success', 'Slide deleted.');
    }

}
