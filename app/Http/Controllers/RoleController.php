<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    // Vue HTML
    public function index()
    {
        try {
            $roles = $this->roleRepository->liste();
            return view('roles.index', compact('Roles'));
        } catch (Exception $e) {
            Log::error('Erreur lors de l affichage des Roles : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue.');
        }
    }

    // Création
    public function store(RoleRequest $request)
    {
        try {
            $role = $this->roleRepository->ajouter($request->validated());

            return response()->json([
                'status' => 'success',
                'Role' => 'Role ajouté avec succès.',
                'data' => $role
            ]);
        } catch (Exception $e) {
            Log::error('Erreur store Role : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'Role' => 'Erreur lors de l enregistrement du Role.'
            ], 500);
        }
    }

    // Afficher pour modification
    public function show($id)
    {
        try {
            $role = $this->roleRepository->rechercher($id);

            if (!$role) {
                return response()->json([
                    'status' => 'error',
                    'Role' => 'Role introuvable.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $role
            ]);
        } catch (Exception $e) {
            Log::error('Erreur show Role : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'Role' => 'Erreur lors de la récupération.'
            ], 500);
        }
    }

    // Mise à jour
    public function update(RoleRequest $request, $id)
    {
        try {
            $role = $this->roleRepository->rechercher($id);

            if (!$role) {
                return response()->json([
                    'status' => 'error',
                    'Role' => 'Role non trouvé.'
                ], 404);
            }

            $updated = $this->roleRepository->modifier($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'Role' => 'Role mis à jour avec succès.',
                'data' => $updated
            ]);
        } catch (Exception $e) {
            Log::error('Erreur update Role : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'Role' => 'Échec de la mise à jour.'
            ], 500);
        }
    }

    // Suppression
    public function destroy($id)
    {
        try {
            $role = $this->roleRepository->rechercher($id);

            if (!$role) {
                return response()->json([
                    'status' => 'error',
                    'Role' => 'Role non trouvé.'
                ], 404);
            }

            $this->roleRepository->delete($id);

            return response()->json([
                'status' => 'success',
                'Role' => 'Role supprimé avec succès.'
            ]);
        } catch (Exception $e) {
            Log::error('Erreur destroy Role : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'Role' => 'Erreur lors de la suppression.'
            ], 500);
        }
    }
}

