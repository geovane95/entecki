<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CompetenceRequest extends FormRequest
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
            'month' => 'required',
            'year' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'month.required' => 'Um mês é necessário para cadastro de mês de referencia',
            'year.required' => 'Um ano é necessário para cadastro de mês de referencia',
        ];
    }
}
