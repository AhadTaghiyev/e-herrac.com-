<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the validation rules that apply to the update request.
     *
     * @return array
     */
    public function updateRules($slide)
    {
        return [
            'title' => 'required',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'is_active' => 'boolean',
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
                    return $this->updateRules($this->route('slide'));
                }
            default: return [];
        }
    }


}
