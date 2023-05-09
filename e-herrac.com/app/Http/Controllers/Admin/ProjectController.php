<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:project-list|project-create|project-edit|project-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:project-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:project-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:project-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = new Project;
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->content = $request->input('content');
        $project->client = $request->input('client');
        $project->location = $request->input('location');
        $project->type = $request->input('type');
        $project->size = $request->input('size');
        $project->is_featured = $request->input('is_featured', false);
        $project->is_active = $request->input('is_active');
        $project->save();
        processSingleMedia($project, 'image', 'image', $request);
        processMultipleMedia($project, 'images', 'images', $request);
        return redirect()->route('admin.projects.index')->with('success', 'Project added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->content = $request->input('content');
        $project->client = $request->input('client');
        $project->location = $request->input('location');
        $project->type = $request->input('type');
        $project->size = $request->input('size');
        $project->is_featured = $request->input('is_featured', false);
        $project->is_active = $request->input('is_active');
        $project->save();
        processSingleMedia($project, 'image', 'image', $request);
        processMultipleMedia($project, 'images', 'images', $request);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }

}
