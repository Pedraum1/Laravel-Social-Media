<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetEmailRequest extends FormRequest
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
            'emailInput' => 'email|required'
        ];
    }

    public function messages():array{
        return [
            'emailInput.email'    => 'O Email inserido deve ser válido.',
            'emailInput.required' => 'Você precisa inserir um email.'
        ];
    }
}
