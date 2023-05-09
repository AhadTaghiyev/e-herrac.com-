<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isNull;

class MenuItem extends Model {

    protected $with = ['childs'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function childs() {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order', 'asc');
    }

    /**
     * Get the menu item's url.
     *
     * @param  string  $value
     * @return string
     */
    public function getUrlAttribute($value)
    {
        switch ($this->getAttribute('relation_type')) {
            case 'home':
                return route('home');
                break;
            case 'category':
                $category = Category::find($this->getAttribute('relation_object'));
                return route('category', $category->path);
                break;
            case 'page':
                $page = Page::find($this->getAttribute('relation_object'));
                return $page->template === 'home' ? route('home') : route('page', $page->slug);
                break;
            case 'external_url':
            default:
                return !is_null($value) && $value !== '' ? $value : route('home');
                break;
        }
    }

    /**
     * Get the menu item's label.
     *
     * @param  string  $value
     * @return string
     */
    public function getLabelAttribute($value)
    {
        if(!is_null($value)) {
            return $value;
        }
        switch ($this->getAttribute('relation_type')) {
            case 'home':
                return 'Ana səhifə';
                break;
            case 'category':
                $category = Category::find($this->getAttribute('relation_object'));
                return $category->name;
                break;
            case 'page':
                $page = Page::find($this->getAttribute('relation_object'));
                return $page->name;
                break;
            case 'external_url':
            default:
                return $value;
                break;
        }

    }

    public function getIsCurrentAttribute() {
        switch ($this->getAttribute('relation_type')) {
            case 'home':
                return url()->current() === route('home');
                break;
            case 'page':
                $page = Page::find($this->getAttribute('relation_object'));
                if($page->template === 'home' && request()->route()->getName() === 'home' ) {
                    return true;
                }
                if(in_array(request()->route()->getName(), [$page->template.'.index', $page->template.'.show'])) {
                    return true;
                }
                return url()->current() === route('page', $page->slug);
                break;
                return false;
        }
    }

}
