<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'eleve_id' => ['nullable', 'integer', 'exists:eleves,id'],
            'matiere_id' => ['nullable', 'integer', 'exists:matieres,id'],
            'enseignant_id' => ['nullable', 'integer', 'exists:users,id'], // suppose que les enseignants sont dans la table users
            'devoir_id' => ['nullable', 'integer', 'exists:devoirs,id'],
            'valeur' => ['required', 'numeric', 'between:0,20'],
            'date_note' => ['required', 'date'],

        ];
    }

    public function messages(): array
    {
        return [
            'eleve_id.exists' => 'L’élève sélectionné est invalide.',
            'matiere_id.exists' => 'La matière sélectionnée est invalide.',
            'enseignant_id.exists' => 'L’enseignant sélectionné est invalide.',
            'devoir_id.exists' => 'Le devoir sélectionné est invalide.',
            'valeur.required' => 'La note est obligatoire.',
            'valeur.between' => 'La note doit être comprise entre 0 et 20.',
            'valeur.numeric' => 'La note doit être un nombre.',
            'date_note.required' => 'La date de la note est obligatoire.',
            'date_note.date' => 'La date de la note n’est pas valide.',
           
        ];
    }
}
