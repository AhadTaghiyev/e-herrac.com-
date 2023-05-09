<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

function buildTreeSelect($categories, $prefix = '', $default = null) {
    foreach ($categories as $category) {
        echo '<option value="'.$category->id.'" '.($default === $category->id ? ' selected' : '').'>'. PHP_EOL.$prefix.' '.$category->name .'</option>';
        buildTreeSelect($category->children, '-'.$prefix, $default);
    }
};

function buildTree($tree, $r = 0, $p = null, &$data = []) {
    foreach ($tree as $t) {
        $dash = is_null($t->parent_id) ? '' : str_repeat('-', $r) .' ';
        $item = new stdClass;
        $item->id = $t->id;
        $item->text = $dash . (isset($t->name) ? $t->name : $t->label);
        $data[] = $item;
        if ($t->parent_id === $p) {
             $r = 0;
        }
        if ($t->childs->count()) {
            buildTree($t->childs, ++$r, $t->parent_id, $data);
        }
    }
    return $data;
}

function processSingleMedia(Model $model, string $inputName, string $collectionName, Request $request) {
    if($request->hasFile($inputName)) {
        $model->addMediaFromRequest($inputName)->toMediaCollection($collectionName);
    } else if ($request->input('fileuploader-list-' . $inputName) === '[]') {
        $model->clearMediaCollection($collectionName);
    }
}

function processMultipleMedia(Model $model, string $inputName, string $collectionName, Request $request) {
    if ($request->has('fileuploader-list-' . $inputName) && !is_null($request->get('fileuploader-list-' . $inputName))) {
        $images = array_map(function($item) {
            return $item['model_id'];
        }, array_filter(json_decode($request->input('fileuploader-list-' . $inputName), true), function($item) {
            return isset($item['model_id']);
        }));
        foreach($model->getMedia($collectionName) as $media) {
            if(!in_array($media->id, $images)) {
                $media->delete();
            }
        }
    }
    if($request->hasFile($inputName)) {
        foreach($request->file($inputName) as $file) {
            $model->addMedia($file)->toMediaCollection($collectionName);
        }
    }
}


