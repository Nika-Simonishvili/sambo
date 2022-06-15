<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoachStoreRequest extends FormRequest
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
            'name' => 'required',
            'surname' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed|string|min:4:',
            'email' => 'email|unique:users',
            'club' => 'required',
            'tel' => 'required|numeric|digits_between:1,14',
            'profile_picture' => 'nullable|file|mimes:jpeg,png,jpg|max:1024'
        ];
    }
}
