<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function index(Menu $menu)
    {
        return view('admin.menu.item.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function create(Menu $menu)
    {
        $parents = buildTree(MenuItem::whereNull('parent_id')->where('menu_id', $menu->id)->get());
        return view('admin.menu.item.create', compact('menu', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Menu $menu)
    {
        $item = new MenuItem;
        $item->menu_id = $menu->id;
        $item->relation_type = $request->input('relation_type');
        $item->relation_object = $request->input('relation_object');
        $item->label = $request->input('label');
        $item->url = $request->input('url');
        $item->class = $request->input('class');
        $item->target = $request->input('target');
        $item->parent_id = $request->input('parent_id');
        $item->is_active = $request->input('is_active');
        $item->save();
        return redirect()->route('admin.menus.items.index', $menu->id)->with('success', 'Menu item added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @param  \App\Models\MenuItem  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu, MenuItem $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @param  \App\Models\MenuItem  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu, MenuItem $item)
    {
        $parents = buildTree(MenuItem::whereNull('parent_id')->where('id', '!=', $item->id)->where('menu_id', $menu->id)->get());
        return view('admin.menu.item.edit', compact('menu', 'item', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @param  \App\Models\MenuItem  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu, MenuItem $item)
    {
        $item->menu_id = $menu->id;
        $item->relation_type = $request->input('relation_type');
        $item->relation_object = $request->input('relation_object');
        $item->label = $request->input('label');
        $item->url = $request->input('url');
        $item->class = $request->input('class');
        $item->target = $request->input('target');
        $item->parent_id = $request->input('parent_id');
        $item->is_active = $request->input('is_active');
        $item->save();
        return redirect()->route('admin.menus.items.index', $menu->id)->with('success', 'Menu item updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @param  \App\Models\MenuItem  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu, MenuItem $item)
    {
        $item->delete();
        return redirect()->route('admin.menus.items.index', $menu->id)->with('success', 'Menu item deleted.');
    }
}
