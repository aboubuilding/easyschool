<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnonceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // À adapter selon les droits de l’utilisateur connecté
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'contenu' => ['required', 'string'],
            'date_publication' => ['required', 'date', 'before_or_equal:today'],
            'audience' => ['required', 'in:tous,parents,enseignants,eleves'],

        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de l’annonce est obligatoire.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'contenu.required' => 'Le contenu de l’annonce est obligatoire.',
            'date_publication.required' => 'La date de publication est obligatoire.',
            'date_publication.date' => 'La date de publication doit être une date valide.',
            'date_publication.before_or_equal' => 'La date de publication ne peut pas être dans le futur.',
            'audience.required' => 'L’audience est obligatoire.',
            'audience.in' => 'L’audience doit être : tous, parents, enseignants ou élèves.',
          
        ];
    }
}
