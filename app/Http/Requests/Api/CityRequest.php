<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'state' => 'required|exists:states,id',
            'status' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Um nome é necessário para cadastro de cidade',
            'state.required' => 'A vinculação a um estado é necessário para cadastro de cidade',
            'status.required'  => 'É necessário informar se a cidade deve ficar ativa ou inativa'
        ];
    }
}
