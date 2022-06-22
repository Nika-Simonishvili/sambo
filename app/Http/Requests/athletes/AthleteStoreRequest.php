<?php

namespace App\Http\Requests\athletes;

use Illuminate\Foundation\Http\FormRequest;

class AthleteStoreRequest extends FormRequest
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
            'date_of_birth' => 'required|date|date_format:m/d/Y|before:today',
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
            'club' => 'required',
            'profile_picture' => 'nullable|file|mimes:jpeg,png,jpg|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'სახელის შეყვანა აუცილებელია.',
            'surname.required' => 'გვარის შეყვანა აუცილებელია.',
            'date_of_birth.required' => 'დაბადების თარიღის მითითება აუცილებელია.',
            'date_of_birth.date_format' => 'დაბადების თარიღის ფორმატია თვე/დღე/წელი.',
            'date_of_birth.before' => 'დაბადების თარიღი არ შეიძლება იყოს მომავალში.',
            'weight.required' => 'წონის შეყვანა აუცილებელია.',
            'weight.numeric' => 'წონა უნდა იყოს ციფრებით.',
            'height.required' => 'სიმაღლის შეყვანა აუცილებელია.',
            'height.numeric' => 'წონა უნდა იყოს ციფრებით.',
            'club.required' => 'კლუბის შეყვანა აუცილებელია.',
        ];
    }
}
