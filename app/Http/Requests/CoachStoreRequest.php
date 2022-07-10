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
            'email' => 'nullable|email|unique:users',
            'club' => 'required',
            'tel' => 'required|numeric|digits_between:9,14',
            // 'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'სახელის შეყვანა აუცილებელია.',
            'surname.required' => 'გვარის შეყვანა აუცილებელია.',
            'username.required' => 'მომხმარებლის სახელის შეყვანა აუცილებელია.',
            'username.unique' => 'მომხმარებლის სახელი დაკავებულია.',
            'password.required' => 'პაროლის შეყვანა აუცილებელია',
            'password.confirmed' => 'პაროლები არ ემთხვევა.',
            'password.min' => 'პაროლის მინიმალური სიგრძე 5.',
            'email.unique' => 'ე-მეილი დაკავებულია.',
            'club.required' => 'კლუბის შეყვანა აუცილებელია.',
            'tel.required' => 'ტელლეფონის ნომრის შეყვანა აუცილებელია.',
            'tel.numeric' => 'ტელეფონის ნომერი უნდა შედგებოდეს მხოლოდ ციფრებისგან.',
            'tel.digits_between' => 'ტელეფონის ნომერი უნდა შედგებოდეს 9-დან 14 ციფრამდე.',
        ];
    }
}
