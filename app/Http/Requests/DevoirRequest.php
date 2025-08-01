<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DevoirRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'classe_id' => ['nullable', 'integer', 'exists:classes,id'],
            'matiere_id' => ['nullable', 'integer', 'exists:matieres,id'],
            'enseignant_id' => ['nullable', 'integer', 'exists:users,id'], // si les enseignants sont dans la table users
            'contenu' => ['required', 'string'],
            'date_rendu' => ['required', 'date', 'after_or_equal:today'],
            'type' => ['nullable', 'integer', 'in:1,2,3'], // exemple : 1=devoir, 2=contrôle, 3=examen

        ];
    }

    public function messages(): array
    {
        return [
            'classe_id.exists' => 'La classe sélectionnée est invalide.',
            'matiere_id.exists' => 'La matière sélectionnée est invalide.',
            'enseignant_id.exists' => 'L’enseignant sélectionné est invalide.',
            'contenu.required' => 'Le contenu du devoir est obligatoire.',
            'date_rendu.required' => 'La date de rendu est obligatoire.',
            'date_rendu.after_or_equal' => 'La date de rendu doit être aujourd’hui ou ultérieure.',
            'type.in' => 'Le type de devoir est invalide.',
          
        ];
    }
}
