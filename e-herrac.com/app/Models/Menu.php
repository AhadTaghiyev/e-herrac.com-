<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model {
    use SoftDeletes;

     /**
     * List of locations.
     *
     * @var array
     */
    public static $locations = [
        ['location' => 'header', 'name' => 'Header', 'has_dropdown' => true],
        ['location' => 'footer', 'name' => 'Footer', 'has_dropdown' => false],
        ['location' => 'social', 'name' => 'Social', 'has_dropdown' => false],
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class)->orderBy('order', 'desc');
    }

    public function parentItems()
    {
        return $this->hasMany(MenuItem::class)->whereNull('parent_id')->orderBy('order', 'asc');
    }
}
