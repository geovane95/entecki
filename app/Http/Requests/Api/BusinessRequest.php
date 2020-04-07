<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BusinessRequest extends FormRequest
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
            'business_name' => 'required|max:256'
        ];
    }
    public function messages()
    {
        return [
            'business_name.required' => 'Um nome é necessário para cadastro de empresa',
            'business_name.max'  => 'O nome deve conter no maximo 256 caracteres'
        ];
    }
}
