<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => 'required|min:4|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'role' => 'required|exists:roles,id',
            'is_active' => 'required|boolean|in:0,1'
        ];
    }


    /**
     * Get the validation rules that apply to the update request.
     *
     * @return array
     */
    public function updateRules($user)
    {
        return [
            'username' => 'required|min:4|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:4|confirmed',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'role' => 'required|exists:roles,id',
            'is_active' => 'required|boolean|in:0,1'
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
                    return $this->updateRules($this->route('user'));
                }
            default: return [];
        }
    }
}
