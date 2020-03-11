<?php

namespace App\Http\Requests\Api;

use App\Rules\CnpjRule;
use Illuminate\Foundation\Http\FormRequest;

class ResponsibleRequest extends FormRequest
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
            'company_name' => 'required',
            'cnpj' => ['required','min:18','max:18','unique:responsibles', new CnpjRule()]
        ];
    }
    public function messages()
    {
        return [
            'company_name.required' => 'Um nome é necessário para cadastro de responsável',
            'cnpj.required'  => 'Um cnpj é necessário para cadastro de responsável',
            'cnpj.min'  => 'O CNPJ deve conter exatamente 18 caracteres',
            'cnpj.max'  => 'O CNPJ deve conter exatamente 18 caracteres',
            'cnpj.unique'  => 'Este CNPJ já foi cadastrado anteriormente, altere-o na listagem de responsáveis ou cadastre com outro valor',
        ];
    }
}
