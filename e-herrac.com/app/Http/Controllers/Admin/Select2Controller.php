<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  string  $type
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($type = null, Request $request)
    {
        $return = [];
        switch ($type) {
            case 'list':
                $list_type = $request->input('value');
                if($list_type === 'page') {
                    $return = $this->getPageList();
                } else if($list_type === 'category') {
                    $return = $this->getCategoryList();
                }
                break;

            default:
                # code...
                break;
        }
        return response()->json($return);
    }

    private function getPageList() {
        $pages = Page::select('*', 'name as text')->where('is_active', 1)->get();
        return $pages;
    }

    private function getCategoryList() {
        $categories = Category::select('id', 'name')->where('is_active', '1')->whereNull('parent_id')->get();
        return buildTree($categories);
    }
}
