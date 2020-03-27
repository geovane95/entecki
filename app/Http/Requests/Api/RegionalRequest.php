<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegionalRequest extends FormRequest
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
            'name' => 'required|min:4',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Um nome é necessário para cadastro de regional',
            'name.min'  => 'O nome do regional deve conter no minimo 4 caracteres',
        ];
    }
}
