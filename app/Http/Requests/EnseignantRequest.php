<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class EnseignantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // à ajuster selon la politique d'accès
    }

    public function rules(): array
    {
        return [
            'nom' => ['nullable', 'string', 'max:100'],
            'prenom' => ['nullable', 'string', 'max:100'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'diplome' => ['nullable', 'integer'], // Tu peux ajouter une contrainte si tu as une liste de diplômes
            'date_embauche' => ['nullable', 'date'],
            'date_naissance' => ['nullable', 'date'],
            'lieu_naissance' => ['nullable', 'string', 'max:255'],
            'sexe' => ['nullable', 'in:0,1'], // 0 = Femme, 1 = Homme, ou inverse selon convention
           
        ];
    }

    public function messages(): array
    {
        return [
            'nom.string' => 'Le nom doit être une chaîne de caractères.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'telephone.string' => 'Le numéro de téléphone doit être une chaîne valide.',
            'diplome.integer' => 'Le diplôme doit être un entier valide.',
            'date_embauche.date' => 'La date d\'embauche n\'est pas valide.',
            'date_naissance.date' => 'La date de naissance n\'est pas valide.',
            'lieu_naissance.string' => 'Le lieu de naissance doit être une chaîne de caractères.',
            'sexe.in' => 'Le sexe doit être 0 (Femme) ou 1 (Homme).',
           
        ];
    }
}
