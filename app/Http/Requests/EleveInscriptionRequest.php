<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EleveInscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // À adapter selon tes règles d’accès
    }

    public function rules(): array
    {
        $eleveId = $this->route('eleve')?->id ?? null;

        return [
            // --- Données Élève ---
            'matricule' => ['required', 'string', 'max:50', 'unique:eleves,matricule' . ($eleveId ? ',' . $eleveId : '')],
            'nom' => ['required', 'string', 'max:100'],
            'prenom' => ['nullable', 'string', 'max:100'],
            'date_naissance' => ['nullable', 'date'],
            'lieu_naissance' => ['nullable', 'string', 'max:150'],
            'sexe' => ['nullable', 'in:0,1'], // 0 = fille, 1 = garçon (par exemple)
            'photo' => ['nullable', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:users,id'],


            // --- Données Inscription ---
            'cycle_id' => ['nullable', 'integer', 'exists:cycles,id'],
            'niveau_id' => ['nullable', 'integer', 'exists:niveaux,id'],
            'classe_id' => ['nullable', 'integer', 'exists:classes,id'],
            'annee_id' => ['required', 'integer', 'exists:annees,id'],
            'date_inscription' => ['nullable', 'date', 'before_or_equal:today'],
            'statut' => ['nullable', 'in:0,1,2'], // ex: 0 = provisoire, 1 = confirmé, 2 = annulé
            'inscription_etat' => ['required', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            // Élève
            'matricule.required' => 'Le matricule est requis.',
            'matricule.unique' => 'Ce matricule est déjà utilisé.',
            'nom.required' => 'Le nom de l’élève est requis.',
            'sexe.in' => 'Le sexe doit être 0 (fille) ou 1 (garçon).',
            'parent_id.exists' => 'Le parent sélectionné est invalide.',
           

            // Inscription
            'annee_id.required' => 'L’année scolaire est obligatoire.',
            'annee_id.exists' => 'Année invalide.',
            'classe_id.exists' => 'Classe invalide.',
            'niveau_id.exists' => 'Niveau invalide.',
            'cycle_id.exists' => 'Cycle invalide.',
            'date_inscription.before_or_equal' => 'La date d’inscription ne peut pas être dans le futur.',
            'inscription_etat.required' => 'L’état de l’inscription est requis.',
        ];
    }
}
