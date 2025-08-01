<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // À adapter selon la logique d'autorisation
    }

    public function rules(): array
    {
        return [
            'expediteur_id' => ['nullable', 'integer', 'exists:users,id'],
            'destinataire_id' => ['nullable', 'integer', 'exists:users,id'],
            'objet' => ['nullable', 'string', 'max:255'],
            'contenu' => ['required', 'string'],
            'lu' => ['boolean'],

        ];
    }

    public function messages(): array
    {
        return [
            'expediteur_id.exists' => 'L’expéditeur sélectionné est invalide.',
            'destinataire_id.exists' => 'Le destinataire sélectionné est invalide.',
            'objet.max' => 'L’objet ne peut pas dépasser 255 caractères.',
            'contenu.required' => 'Le contenu du message est obligatoire.',
            'lu.boolean' => 'Le champ "lu" doit être vrai ou faux.',
           
        ];
    }
}
