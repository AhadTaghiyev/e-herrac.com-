<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Advertisement extends Model implements HasMedia {
    use HasSlug;
    use InteractsWithMedia;

    public static $currencies = [
        1 => 'AZN',
        2 => 'USD'
    ];

    protected $with = ['auction', 'category', 'region'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
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

    public function auction() {
        return $this->belongsTo(Auction::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function region() {
        return $this->belongsTo(Region::class);
    }

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('image')->singleFile()
        ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif']);

        $this->addMediaCollection('images')
        ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif']);

    }

    public function registerMediaConversions(Media $media = null): void
    {
        // $this->addMediaConversion('700x500')
        // ->crop('crop-center', 700, 500)
        // ->performOnCollections('image');

        $this->addMediaConversion('900x600')
        ->crop('crop-center', 900, 600)
        ->performOnCollections('image');

        $this->addMediaConversion('900x600')
        ->crop('crop-center', 900, 600)
        ->performOnCollections('images');
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
}
