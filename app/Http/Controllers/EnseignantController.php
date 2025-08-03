<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnseignantRequest;
use App\Repositories\Contracts\EnseignantRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class EnseignantController extends Controller
{
    protected $enseignantRepository;

    public function __construct(EnseignantRepositoryInterface $enseignantRepository)
    {
        $this->EnseignantRepository = $enseignantRepository;
    }

    // Vue HTML
    public function index()
    {
        try {
            $enseignants = $this->EnseignantRepository->all();
            return view('Enseignants.index', compact('Enseignants'));
        } catch (Exception $e) {
            Log::error('Erreur lors de l affichage des Enseignants : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue.');
        }
    }

    // Création
    public function store(EnseignantRequest $request)
    {
        try {
            $enseignant = $this->EnseignantRepository->create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Enseignant ajouté avec succès.',
                'data' => $enseignant
            ]);
        } catch (Exception $e) {
            Log::error('Erreur store Enseignant : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de l enregistrement du Enseignant.'
            ], 500);
        }
    }

    // Afficher pour modification
    public function show($id)
    {
        try {
            $enseignant = $this->EnseignantRepository->findById($id);

            if (!$enseignant) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Enseignant introuvable.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $enseignant
            ]);
        } catch (Exception $e) {
            Log::error('Erreur show Enseignant : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération.'
            ], 500);
        }
    }

    // Mise à jour
    public function update(EnseignantRequest $request, $id)
    {
        try {
            $enseignant = $this->EnseignantRepository->findById($id);

            if (!$enseignant) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Enseignant non trouvé.'
                ], 404);
            }

            $updated = $this->EnseignantRepository->update($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Enseignant mis à jour avec succès.',
                'data' => $updated
            ]);
        } catch (Exception $e) {
            Log::error('Erreur update Enseignant : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Échec de la mise à jour.'
            ], 500);
        }
    }

    // Suppression
    public function destroy($id)
    {
        try {
            $enseignant = $this->EnseignantRepository->findById($id);

            if (!$enseignant) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Enseignant non trouvé.'
                ], 404);
            }

            $this->EnseignantRepository->delete($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Enseignant supprimé avec succès.'
            ]);
        } catch (Exception $e) {
            Log::error('Erreur destroy Enseignant : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression.'
            ], 500);
        }
    }
}

