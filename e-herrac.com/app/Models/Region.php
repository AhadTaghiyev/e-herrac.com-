<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Region extends Model {
    use HasSlug;
    use NodeTrait;

    protected static function boot() {
        parent::boot();
        static::creating(function (self $model) {
            if ($model->isDirty('slug', 'parent_id')) {
                $model->generatePath();
            }
        });
        static::updating(function (self $model) {
            if ($model->isDirty('slug', 'parent_id')) {
                $model->generatePath();
            }
        });
        static::saved(function (self $model) {
            static $updating = false;
            if ( ! $updating && $model->isDirty('path')) {
                $updating = true;
                $model->updateDescendantsPaths();
                $updating = false;
            }
        });
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName() {
        if(in_array(request()->route()->getPrefix(), [app()->getLocale() .'/admin', '/admin'])) {
            return 'id';
        } else {
            return 'slug';
        }
    }

    private function generatePath() {
        $slug = $this->slug;
        $this->path = $this->isRoot() ? $slug : $this->parent->path.'/'.$slug;
        return $this;
    }

    public function updateDescendantsPaths() {
        $descendants = $this->descendants()->defaultOrder()->get();
        $descendants->push($this)->linkNodes()->pop();
        foreach ($descendants as $model) {
            $model->generatePath()->save();
        }
    }

}
