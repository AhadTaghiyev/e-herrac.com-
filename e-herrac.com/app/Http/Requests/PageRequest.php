<?php

namespace App\Http\Requests;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the create request.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'name' => 'required',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'is_active' => 'boolean',
            'template' => 'required|in:' . implode(',', array_keys(Page::$templates)),
        ];
    }

    /**
     * Get the validation rules that apply to the update request.
     *
     * @return array
     */
    public function updateRules($page)
    {
        return [
            'name' => 'required',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'is_active' => 'boolean',
            'template' => 'required|in:' . implode(',', array_keys(Page::$templates)),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return $this->createRules();
                }
            case 'PUT':
            case 'PATCH':
                {
                    return $this->updateRules($this->route('page'));
                }
            default: return [];
        }
    }


}
