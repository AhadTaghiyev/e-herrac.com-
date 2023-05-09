<?php

namespace App\Http\View\Composers;

use App\Models\Page;
use Illuminate\View\View;

class PageComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $_PAGES = [];
        $pages = Page::whereNotNull('template')->where('is_active', true)->get();
        foreach ($pages as $page) {
            $_PAGES[$page->template] = $page;
        }
        $view->with('_PAGES', $_PAGES);
    }
}


?>
