<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Http\Requests\PageRequest;

class PageController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:page-list|page-create|page-edit|page-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:page-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:page-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:page-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Page::where('is_active', true)->get();
        if (array_key_exists(request()->input('template'), Page::$templates)) {
            $template = request()->input('template');
        } else {
            $template = 'default';
        }
        if (view()->exists('admin.pages.templates.' . $template . '.create')) {
            $view = 'admin.pages.templates.' . $template . '.create';
        } else {
            $view = 'admin.pages.create';
        }
        return view($view, compact('parents', 'template'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $page = new Page;
        $page->parent_id = $request->input('parent_id');
        $page->name = $request->input('name');
        $page->description = $request->input('description');
        $page->content = $request->input('content');
        $page->template = $request->input('template');
        $page->is_active = $request->input('is_active');
        $page->save();
        if ($request->has('meta')) {
            foreach($request->input('meta') as $meta_key => $meta_value) {
                $page->setMeta($meta_key, $meta_value);
            }
        }
        processSingleMedia($page, 'image', 'image', $request);
        processMultipleMedia($page, 'images', 'images', $request);
        return redirect()->route('admin.pages.index')->with('success', 'Page added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $parents = Page::where('id', '<>', $page->id)->where('is_active', true)->get();
        if (array_key_exists(request()->input('template'), Page::$templates)) {
            $template = request()->input('template');
        } else {
            $template = $page->template;
        }
        if($template === 'default') {
            return view('admin.pages.edit', compact('page', 'parents', 'template'));
        }
        if (view()->exists('admin.pages.templates.' . $template . '.edit')) {
            $view = 'admin.pages.templates.' . $template . '.edit';
        } else {
            $view = 'admin.pages.edit';
        }
        return view($view, compact('page', 'parents', 'template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PageRequest  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->parent_id = $request->input('parent_id');
        $page->name = $request->input('name');
        $page->description = $request->input('description');
        $page->content = $request->input('content');
        $page->template = $request->input('template');
        $page->is_active = $request->input('is_active');
        $page->save();
        if ($request->has('meta')) {
            foreach($request->input('meta') as $meta_key => $meta_value) {
                $page->setMeta($meta_key, $meta_value);
            }
        }
        processSingleMedia($page, 'image', 'image', $request);
        processMultipleMedia($page, 'images', 'images', $request);
        return redirect()->route('admin.pages.index')->with('success', 'Page updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted.');
    }

}
