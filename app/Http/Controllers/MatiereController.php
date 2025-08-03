<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatiereRequest;
use App\Repositories\Contracts\MatiereRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class MatiereController extends Controller
{
    protected $matiereRepository;

    public function __construct(MatiereRepositoryInterface $matiereRepository)
    {
        $this->matiereRepository = $matiereRepository;
    }

    // Vue HTML
    public function index()
    {
        try {
            $matieres = $this->matiereRepository->all();
            return view('Matieres.index', compact('Matieres'));
        } catch (Exception $e) {
            Log::error('Erreur lors de l affichage des Matieres : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue.');
        }
    }

    // Création
    public function store(MatiereRequest $request)
    {
        try {
            $matiere = $this->matiereRepository->create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Matiere ajouté avec succès.',
                'data' => $matiere
            ]);
        } catch (Exception $e) {
            Log::error('Erreur store Matiere : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de l enregistrement du Matiere.'
            ], 500);
        }
    }

    // Afficher pour modification
    public function show($id)
    {
        try {
            $matiere = $this->matiereRepository->findById($id);

            if (!$matiere) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Matiere introuvable.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $matiere
            ]);
        } catch (Exception $e) {
            Log::error('Erreur show Matiere : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération.'
            ], 500);
        }
    }

    // Mise à jour
    public function update(MatiereRequest $request, $id)
    {
        try {
            $matiere = $this->matiereRepository->findById($id);

            if (!$matiere) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Matiere non trouvé.'
                ], 404);
            }

            $updated = $this->matiereRepository->update($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Matiere mis à jour avec succès.',
                'data' => $updated
            ]);
        } catch (Exception $e) {
            Log::error('Erreur update Matiere : ' . $e->getMessage());
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
            $matiere = $this->matiereRepository->findById($id);

            if (!$matiere) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Matiere non trouvé.'
                ], 404);
            }

            $this->matiereRepository->delete($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Matiere supprimé avec succès.'
            ]);
        } catch (Exception $e) {
            Log::error('Erreur destroy Matiere : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression.'
            ], 500);
        }
    }
}

