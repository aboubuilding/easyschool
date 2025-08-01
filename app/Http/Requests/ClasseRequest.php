<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasseRequest extends FormRequest
{
    public function authorize(): bool
    {
        // À personnaliser si tu veux restreindre l'accès
        return true;
    }

    public function rules(): array
    {
        $classeId = $this->route('classe')?->id ?? $this->route('classe');

        return [
            'nom' => ['required', 'string', 'max:255', 'unique:classes,nom' . ($classeId ? ',' . $classeId : '')],
            'cycle_id' => ['nullable', 'integer', 'exists:cycles,id'],
            'niveau_id' => ['nullable', 'integer', 'exists:niveaux,id'],
            'annee_id' => ['nullable', 'integer', 'exists:annees,id'],

        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la classe est obligatoire.',
            'nom.unique' => 'Ce nom de classe existe déjà.',
            'cycle_id.exists' => 'Le cycle sélectionné est invalide.',
            'niveau_id.exists' => 'Le niveau sélectionné est invalide.',
            'annee_id.exists' => 'L\'année sélectionnée est invalide.',
           
        ];
    }
}
