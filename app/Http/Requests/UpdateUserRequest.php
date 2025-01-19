<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->user->id,
            'image' => 'sometimes|image',
            'password' => 'required|confirmed|string|min:8',
            // 'role' => 'required|in:super_admin,admin,user',
            'permissions' => 'required|array',
            'permissions.*' => 'string|in:create_users,read_users,update_users,delete_users',
        ];
    }
}
