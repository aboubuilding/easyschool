<?php

namespace App\Http\Controllers;

use App\Http\Requests\NiveauRequest;
use App\Repositories\Contracts\NiveauRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class NiveauController extends Controller
{
    protected $niveauRepository;

    public function __construct(NiveauRepositoryInterface $niveauRepository)
    {
        $this->niveauRepository = $niveauRepository;
    }

    // Vue HTML
    public function index()
    {
        try {
            $niveaus = $this->niveauRepository->all();
            return view('Niveaus.index', compact('Niveaus'));
        } catch (Exception $e) {
            Log::error('Erreur lors de l affichage des Niveaus : ' . $e->getNiveau());
            return back()->with('error', 'Une erreur est survenue.');
        }
    }

    // Création
    public function store(NiveauRequest $request)
    {
        try {
            $niveau = $this->niveauRepository->create($request->validated());

            return response()->json([
                'status' => 'success',
                'Niveau' => 'Niveau ajouté avec succès.',
                'data' => $niveau
            ]);
        } catch (Exception $e) {
            Log::error('Erreur store Niveau : ' . $e->getNiveau());
            return response()->json([
                'status' => 'error',
                'Niveau' => 'Erreur lors de l enregistrement du Niveau.'
            ], 500);
        }
    }

    // Afficher pour modification
    public function show($id)
    {
        try {
            $niveau = $this->niveauRepository->findById($id);

            if (!$niveau) {
                return response()->json([
                    'status' => 'error',
                    'Niveau' => 'Niveau introuvable.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $niveau
            ]);
        } catch (Exception $e) {
            Log::error('Erreur show Niveau : ' . $e->getNiveau());
            return response()->json([
                'status' => 'error',
                'Niveau' => 'Erreur lors de la récupération.'
            ], 500);
        }
    }

    // Mise à jour
    public function update(NiveauRequest $request, $id)
    {
        try {
            $niveau = $this->niveauRepository->findById($id);

            if (!$niveau) {
                return response()->json([
                    'status' => 'error',
                    'Niveau' => 'Niveau non trouvé.'
                ], 404);
            }

            $updated = $this->niveauRepository->update($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'Niveau' => 'Niveau mis à jour avec succès.',
                'data' => $updated
            ]);
        } catch (Exception $e) {
            Log::error('Erreur update Niveau : ' . $e->getNiveau());
            return response()->json([
                'status' => 'error',
                'Niveau' => 'Échec de la mise à jour.'
            ], 500);
        }
    }

    // Suppression
    public function destroy($id)
    {
        try {
            $niveau = $this->niveauRepository->findById($id);

            if (!$niveau) {
                return response()->json([
                    'status' => 'error',
                    'Niveau' => 'Niveau non trouvé.'
                ], 404);
            }

            $this->niveauRepository->delete($id);

            return response()->json([
                'status' => 'success',
                'Niveau' => 'Niveau supprimé avec succès.'
            ]);
        } catch (Exception $e) {
            Log::error('Erreur destroy Niveau : ' . $e->getNiveau());
            return response()->json([
                'status' => 'error',
                'Niveau' => 'Erreur lors de la suppression.'
            ], 500);
        }
    }
}

