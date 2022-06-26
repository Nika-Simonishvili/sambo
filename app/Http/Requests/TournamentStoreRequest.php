<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TournamentStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'location' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'referees' => 'array'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'ტურნირის სახელის შეყვანა აუცილებელია.',
            'location.required' => 'ტურნირის ჩატარების ადგილის შეყვანა აუცილებელია.',
            'start_date.required' => 'ტურნირის დაწყების თარიღის შეყვანა აუცილებელია.',
            'start_date.date' => 'დაწყების თარიღი შეიყვანეთ სწორი ფორმატით: თთ/დდ/წწწწ.',
            'end_date.date' => 'დამთავრების თარიღი შეიყვანეთ სწორი ფორმატით: თთ/დდ/წწწწ.',
            'end_date.required' => 'ტურნირის დამთავრების თარიღის შეყვანა აუცილებელია.',
            'end_date.after' => 'დამთავრების თარიღი უნდა იყოს დაწყების თარიღის შემდეგ'
        ];
    }
}
