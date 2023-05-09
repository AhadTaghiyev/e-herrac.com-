<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Slide extends Model implements HasMedia {
    use InteractsWithMedia;

    public function registerMediaCollections() : void {
        $this->addMediaCollection('image')->singleFile()
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
}
