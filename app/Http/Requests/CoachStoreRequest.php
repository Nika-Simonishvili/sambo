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
            'club' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|string|min:4:'
        ];
    }
}
