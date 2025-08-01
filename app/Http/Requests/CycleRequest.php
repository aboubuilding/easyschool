<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CycleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $cycleId = $this->route('cycle')?->id ?? $this->route('cycle');

        return [
            'nom' => [
                'required',
                'string',
                'max:255',
                'unique:cycles,nom' . ($cycleId ? ',' . $cycleId : ''),
            ],
            'etat' => ['required', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du cycle est obligatoire.',
            'nom.unique' => 'Ce nom de cycle existe déjà.',
            'etat.required' => 'Le champ état est requis.',
            'etat.in' => 'L\'état doit être 0 (inactif) ou 1 (actif).',
        ];
    }
}
