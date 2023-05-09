<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use App\Http\Requests\RegionRequest;

class RegionController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:region-list|region-create|region-edit|region-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:region-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:region-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:region-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();
        return view('admin.regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Region::get()->toTree();
        $traverse = function ($regions, $prefix = '') use (&$traverse) {
            foreach ($regions as $region) {
                echo '<option value="'.$region->id.'">'. PHP_EOL.$prefix.' '.$region->name .'</option>';
                $traverse($region->children, $prefix.'-');
            }
        };
        return view('admin.regions.create', compact('parents', 'traverse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RegionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionRequest $request)
    {
        $region = new Region;
        $region->name = $request->input('name');
        $region->parent_id = $request->input('parent_id');
        $region->is_active = $request->input('is_active');
        $region->save();
        return redirect()->route('admin.regions.index')->with('success', 'Region added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        $parents = Region::where('id', '<>', $region->id)->get()->toTree();
        $traverse = function ($regions, $prefix = '', $default = null) use (&$traverse) {
            foreach ($regions as $region) {
                echo '<option value="'.$region->id.'" '.($default === $region->id ? ' selected' : '').'>'. PHP_EOL.$prefix.' '.$region->name .'</option>';
                $traverse($region->children, $prefix.'-');
            }
        };
        return view('admin.regions.edit', compact('region', 'parents', 'traverse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RegionRequest  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(RegionRequest $request, Region $region)
    {
        $region->name = $request->input('name');
        $region->parent_id = $request->input('parent_id');
        $region->is_active = $request->input('is_active');
        $region->save();
        return redirect()->route('admin.regions.index')->with('success', 'Region updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('admin.regions.index')->with('success', 'Region deleted.');
    }

}
