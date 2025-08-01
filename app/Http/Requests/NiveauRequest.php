<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NiveauRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Pour l'update : récupérer l'ID du niveau depuis la route (automatiquement injecté dans web.php : /niveaux/{niveau})
        $niveauId = $this->route('niveau')?->id ?? $this->route('niveau');

        return [
            'nom' => [
                'required',
                'string',
                'max:255',
                'unique:niveaux,nom' . ($niveauId ? ',' . $niveauId : ''),
            ],
            'cycle_id' => ['nullable', 'integer', 'exists:cycles,id'],
            'annee_id' => ['nullable', 'integer', 'exists:annees,id'],

        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du niveau est obligatoire.',
            'nom.unique' => 'Ce nom est déjà utilisé.',
            'cycle_id.exists' => 'Le cycle sélectionné est invalide.',
            'annee_id.exists' => 'L\'année sélectionnée est invalide.',
            
        ];
    }
}
