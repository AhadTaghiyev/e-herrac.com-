<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:service-list|service-create|service-edit|service-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:service-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:service-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:service-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service;
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->content = $request->input('content');
        $service->is_featured = $request->input('is_featured', false);
        $service->is_active = $request->input('is_active');
        $service->save();
        processSingleMedia($service, 'image', 'image', $request);
        processMultipleMedia($service, 'images', 'images', $request);
        return redirect()->route('admin.services.index')->with('success', 'Service added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ServiceRequest  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->content = $request->input('content');
        $service->is_featured = $request->input('is_featured', false);
        $service->is_active = $request->input('is_active');
        $service->save();
        processSingleMedia($service, 'image', 'image', $request);
        processMultipleMedia($service, 'images', 'images', $request);
        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }

}
