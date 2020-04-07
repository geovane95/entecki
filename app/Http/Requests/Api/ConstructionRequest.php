<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ConstructionRequest extends FormRequest
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
            'name'=>'required|min:7',
            'company' => 'required|min:7',
            'business' => 'required|exists:businesses,id',
            'regional' => 'required|exists:regionals,id',
            'neighborhood' => 'required',
            'zipCode' => 'required|min:9|max:9',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'status' => 'required',
            'street' => 'required',
            'number' => 'required',
            'contract_regime' => 'required',
            'reporting_regime' => 'required',
            'work_number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'O nome da obra é obrigatório',
            'name.min'=>'O nome da obra deve conter no minimo 7 caracteres',
            'business.required' => 'O nome da construtora é obrigatório',
            'business.min'=>'O nome da construtora deve ter no minimo 7 caracteres',
            'business.required' => 'Responsável não pode ficar em branco.',
            'business.exists' => 'Responsável tem que ser algum já cadastrado na base de dados.',
            'neighborhood.required' => 'Bairro não pode ficar em branco',
            'zipCode.required' => 'CEP não pode ficar em branco',
            'zipCode.min' => 'CEP deve ter exatamente 8 caracteres',
            'zipCode.max' => 'CEP deve ter exatamente 8 caracteres',
            'city.required' => 'Cidade é obrigatório',
            'status.required' => 'status é obrigatório',
            'street.required' => 'Logradouo  é obrigatório',
            'number.required' => 'Número da residencia é obrigatório',
            'contract_regime.required' => 'Regime de contrato é obrigatório',
            'reporting_regime.required' => 'Relatório dem que aparecer também',
            'issuance_date.required' => 'Data de emissão é obrigaótio',
            'work_number.required' => 'Work Number não pode estar em branco',
        ];
    }
}
