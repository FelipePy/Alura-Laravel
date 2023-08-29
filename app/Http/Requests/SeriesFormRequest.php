<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3'],
            #'seasonsQty' => ['required', 'after_or_equal:1'],
            #'episodesPerSeason' => ['required', 'after_or_equal:1']
        ];
    }

    # Invés de usarmos essa função, poderiamos mudar a língua utilizada pelo nossos sistema
    # Saiba mais lendo a página de 'localization' na documentação do laravel.
    public function messages()
    {
        return [
            'name.required' => "O campo 'nome' é obrigatório.",
            'name.min' => 'É necessário ter no mínimo :min caracteres no nome da série.',
            'seasonsQty.required' => "O campo 'N° Temporadas' é obrigatório.",
            'episodesPerSeason.required' => "O campo 'N° Episódios' é obrigatório.",
        ];
    }
}
