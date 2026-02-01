<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'subdomain' => 'required|string|unique:domains,domain',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do tenant é obrigatório',
            'subdomain.required' => 'O domínio é obrigatório',
            'subdomain.unique' => 'Este domínio já está em uso',
        ];
    }
}
