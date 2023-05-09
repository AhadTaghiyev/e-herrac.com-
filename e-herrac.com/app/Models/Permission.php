<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission {
    public function scopeGrouped($query) {
        $permissions = $query->get();
        $items = [];
        foreach ($permissions as $value) {
            $name = explode('-', $value->name);
            $value->name = $name[1];
            $items[$name[0]][] = $value;
        }
        return $items;
    }

}
