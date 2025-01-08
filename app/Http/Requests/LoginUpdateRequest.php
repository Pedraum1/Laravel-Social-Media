<?php

namespace App\Http\Requests;

use App\Rules\BannerNameLength;
use App\Rules\ProfileNameLength;
use Illuminate\Foundation\Http\FormRequest;

class LoginUpdateRequest extends FormRequest
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
            'nameInput'        => 'required|min:6|max:30',
            'descriptionInput' => 'string|max:255|nullable|regex:/^[a-zA-Z0-9\s.,!?()@#_-]+$/',
            'profileInput'     => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048', new ProfileNameLength(60)],
            'bannerInput'      => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096', new BannerNameLength(60)]
        ];
    }

    public function messages(): array {
        return [
            'nameInput.required' => 'O Campo de nome precisa estar preenchido',
            'nameInput.min'      => 'O Nome deve ter mais que 6 caracteres',
            'nameInput.max'      => 'O Nome deve ter menos que 6 caracteres',

            'profileInput.image' => 'O arquivo da foto de perfil deve ser uma imagem',
            'profileInput.mimes' => 'O arquivo da deve estar no formato PNG, JPG, JPEG ou WEBP',
            'profileInput.max'   => 'O Arquivo enviado da foto de perfil é muito grande (Max: 2Mb)',

            'bannerInput.image' => 'O arquivo do banner de perfil deve ser uma imagem',
            'bannerInput.mimes' => 'O arquivo da deve estar no formato PNG, JPG, JPEG ou WEBP',
            'bannerInput.max'   => 'O Arquivo enviado do banner de perfil é muito grande (Max: 4Mb)',

            'descriptionInput.string' => 'O texto inserido na descrição é inválido',
            'descriptionInput.max'    => 'O tamanho do texto da descrição deve ser de 255 caracteres no máximo',
            'descriptionInput.regex'  => 'O texto inserido na descrição possui caracteres inválidos'
        ];
    }
}
