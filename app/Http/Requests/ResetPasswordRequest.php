<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'idInput'                    => 'required',
            'passwordInput'              => 'required|min:5|max:24|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'passwordInput_confirmation' => 'required|same:passwordInput'
        ];
    }

    public function messages():array {
        return [
            'passwordInput.required' => 'A Senha é obrigatório',
            'passwordInput.min'      => 'A Senha deve ter no mínimo 5 caracteres',
            'passwordInput.max'      => 'A Senha deve ter no máximo 24 caracteres',
            'passwordInput.regex'    => 'A Senha deve ter pelo menos 1 letra maiúscula, 1 letra minúscula e 1 digito',

            'passwordInput_confirmation.required' => 'A Senha precisa ser confirmada',
            'passwordInput_confirmation.same'     => 'As senhas inseridas não batem'
        ];
    }
}
