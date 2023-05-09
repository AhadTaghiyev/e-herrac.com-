<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Plank\Metable\Metable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model implements HasMedia {
    use HasSlug;
    use InteractsWithMedia;
    use Metable;
    use NodeTrait;

    protected $with = ['meta'];

    /**
     * List of templates.
     *
     * @var array
     */
    public static $templates = [
        'default' => 'Default',
        'home' => 'Home',
        'about' => 'About',
        'contact' => 'Contact',
        'advertisements' => 'Advertisements',
    ];

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

    public function parent() {
        return $this->belongsTo(Page::class);
    }

    public function childs() {
        return $this->hasMany(Page::class)->orderBy('id', 'desc');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        if(in_array(request()->route()->getPrefix(), ['/admin'])) {
            return 'id';
        } else {
            return 'slug';
        }
    }

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('cover_image')->singleFile()
        ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif']);

        $this->addMediaCollection('image')->singleFile()
        ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif']);

        $this->addMediaCollection('images')
        ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif']);
    }

    public function getPreloadedMedia($collectionName = 'default') {
        if($this->hasMedia($collectionName)) {
            return $this->getMedia($collectionName)->map(function ($item) {
                return [
                    'name' => $item->file_name,
                    'size' => $item->size,
                    'type' => $item->mime_type,
                    'file' => $item->getFullUrl(),
                    'data' => [
                        'listProps' => ['model_id' => $item->id]
                    ],
                ];
            })->toJson();
        }
    }

    public function setTemplateAttribute($value) {
        $this->attributes['template'] = $value === 'default' ? null : $value;
    }

    public function getTemplateAttribute($value) {
        return is_null($value) ? 'default' : $value;
    }

    public function getIsCurrentAttribute() {
        if($this->template === 'home' && request()->route()->getName() === 'home' ) {
            return true;
        }
        return request()->url() === route('page', $this->attributes['slug']);
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
