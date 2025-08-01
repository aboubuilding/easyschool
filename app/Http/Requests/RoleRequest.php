<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        // À adapter selon ta logique de permission
        return true;
    }

    public function rules(): array
    {
        $roleId = $this->route('role')?->id ?? $this->route('role'); // pour update

        return [
            'nom' => ['required', 'string', 'max:255', 'unique:roles,nom' . ($roleId ? ',' . $roleId : '')],

        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du rôle est obligatoire.',
            'nom.unique' => 'Ce nom de rôle est déjà utilisé.',
            
        ];
    }
}
