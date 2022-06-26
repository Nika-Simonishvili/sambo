<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefereeStoreRequest extends FormRequest
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
            'description' => 'nullable',
            'profile_picture' => 'nullable|file|mimes:jpeg,png,jpg|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'სახელის შეყვანა აუცილებელია.',
            'surname.required' => 'გვარის შეყვანა აუცილებელია.',
            // 'profile_picture.mimes' => 'ფოტო უნდა იყოს jpeg ან png ან jpg გაფართოების.',
            // 'profile_picture.max' => 'ფოტოს მაქსიმალური ზომაა 1მბ.'
        ];
    }
}
