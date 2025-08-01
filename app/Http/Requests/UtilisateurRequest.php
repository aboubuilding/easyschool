<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UtilisateurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adapter si besoin selon les permissions
    }

    public function rules(): array
    {
        // Si on est dans un update, on exclut l'email de l'utilisateur actuel de la règle unique
        $utilisateurId = $this->route('utilisateur')?->id ?? null;

        $rules = [
            'nom' => ['required', 'string', 'max:100'],
            'prenom' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('utilisateurs', 'email')->ignore($utilisateurId),
            ],
            'role_id' => ['nullable', 'integer', 'exists:roles,id'],

        ];

        // Le mot de passe est requis à la création, mais facultatif à la modification
        if ($this->isMethod('post')) {
            $rules['password'] = ['required', 'string', 'min:6', 'confirmed'];
        } else {
            $rules['password'] = ['nullable', 'string', 'min:6', 'confirmed'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est requis.',
            'prenom.required' => 'Le prénom est requis.',
            'email.required' => 'L\'adresse email est requise.',
            'email.email' => 'L\'adresse email est invalide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'role_id.exists' => 'Le rôle sélectionné est invalide.',
           
        ];
    }
}
