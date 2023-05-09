<?php

namespace App\Http\View\Composers;

use App\Models\Menu;
use Illuminate\View\View;

class CommonComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $menus = [];
        $all_menus = Menu::with('parentItems')->where('is_active', true)->get();
        foreach ($all_menus as $menu) {
            $menus[$menu->location] = $menu->parentItems;
        }
        $view->with('menus', $menus);
    }
}


?>
