<?php

namespace App\Http\Requests;

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
            'birth_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')),
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
            'club' => 'required'
        ];
    }
}
