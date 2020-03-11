<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
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


            // $id = request()->hidden_id ;
            return [
                'name'=>'required|min:3|max:150',
                'company'=>'required|min:3|max:150',
                'password'=>'required|min:6|max:100',
                'email'=>"required"
            ];


    }


    public function messages()
    {
        return [

            'name.required'=>'Campo Nome é obrigatório',
            'company.required'=>'Campo Empresa é obrigatório',
            'password.required'=>'Campo Senha é obrigatório',
            'email.required'=>'Campo E-mail é obrigatório',
            'name.min'=>'Campo nome precisa de no mínimo 3 caracteres',
            'password.min'=>'Campo Senha precisa de no mínimo 6 caracteres',
            'email.unique'=>'Você não pode escolher esse email',


        ];
    }
}
