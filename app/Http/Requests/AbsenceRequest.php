<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'eleve_id' => ['nullable', 'integer', 'exists:eleves,id'],
            'date_absence' => ['required', 'date'],
            'heure_absence' => ['nullable', 'date_format:H:i'],
            'retard' => ['boolean'],
            'motif' => ['nullable', 'string'],
            'justifiee' => ['boolean'],
            'etat' => ['required', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'eleve_id.exists' => 'L\'élève sélectionné est invalide.',
            'date_absence.required' => 'La date d\'absence est obligatoire.',
            'date_absence.date' => 'La date d\'absence doit être une date valide.',
            'heure_absence.date_format' => 'L\'heure d\'absence doit être au format HH:MM.',
            'retard.boolean' => 'La valeur de retard doit être vraie ou fausse.',
            'justifiee.boolean' => 'La valeur de justification doit être vraie ou fausse.',
            'etat.required' => 'L\'état est requis.',
            'etat.in' => 'L\'état doit être 0 (inactif) ou 1 (actif).',
        ];
    }
}
