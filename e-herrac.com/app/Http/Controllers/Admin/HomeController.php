<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advertisement;
use App\Models\Auction;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Permission;
use App\Models\Region;
use App\Models\Role;
use App\Models\Slide;
use App\Models\User;
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
        $counts = [];
        $counts['page'] = Page::count();
        $counts['advertisement'] = Advertisement::count();
        $counts['auction'] = Auction::count();
        $counts['category'] = Category::count();
        $counts['region'] = Region::count();
        $counts['slide'] = Slide::count();
        $counts['menu'] = Menu::count();
        $counts['user'] = User::where(function($query) {
            if (!auth()->user()->hasRole('Super Admin')) {
                $query->withoutRole('Super Admin');
            }
        })->count();
        $counts['role'] = Role::where(function($query) {
            if (auth()->user()->hasRole('Super Admin')) {
                return $query->where('name', '!=', 'Super Admin');
            }
        })->count();
        $counts['permission'] = Permission::count();

        return view('admin.home', compact('counts'));
    }
}
