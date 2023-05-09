<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Page;

class PageController extends Controller
{

    public function __invoke(Page $page)
    {
        $template = array_key_exists($page->template, Page::$templates) ? $page->template : 'default';

        $breadcrumb = [];
        $breadcrumb[] = ['title' => 'Ana səhifə', 'url' => route('home'), 'current' => false];
        foreach($page->ancestors as $ancestor) {
            $breadcrumb[] = ['title' => $ancestor->name, 'url' => route('page', $ancestor->path), 'current' => false];
        }
        $breadcrumb[] = ['title' => $page->name, 'url' => route('category', $page->path), 'current' => true];
        $data = ['breadcrumb' => $breadcrumb];
        switch ($page->template) {
            case 'about':
                break;
            default:
                break;
        }
        return view('site.pages.' . $template, compact('page', 'data'));
    }

}
