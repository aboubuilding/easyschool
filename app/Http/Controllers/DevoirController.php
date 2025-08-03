<?php

namespace App\Http\Controllers;

use App\Http\Requests\DevoirRequest;
use App\Repositories\Contracts\DevoirRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class DevoirController extends Controller
{
    protected $devoirRepository;

    public function __construct(DevoirRepositoryInterface $devoirRepository)
    {
        $this->devoirRepository = $devoirRepository;
    }

    // Vue HTML
    public function index()
    {
        try {
            $devoirs = $this->devoirRepository->all();
            return view('Devoirs.index', compact('Devoirs'));
        } catch (Exception $e) {
            Log::error('Erreur lors de l affichage des Devoirs : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue.');
        }
    }

    // Création
    public function store(DevoirRequest $request)
    {
        try {
            $devoir = $this->devoirRepository->create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Devoir ajouté avec succès.',
                'data' => $devoir
            ]);
        } catch (Exception $e) {
            Log::error('Erreur store Devoir : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de l enregistrement du Devoir.'
            ], 500);
        }
    }

    // Afficher pour modification
    public function show($id)
    {
        try {
            $devoir = $this->devoirRepository->findById($id);

            if (!$devoir) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Devoir introuvable.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $devoir
            ]);
        } catch (Exception $e) {
            Log::error('Erreur show Devoir : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération.'
            ], 500);
        }
    }

    // Mise à jour
    public function update(DevoirRequest $request, $id)
    {
        try {
            $devoir = $this->devoirRepository->findById($id);

            if (!$devoir) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Devoir non trouvé.'
                ], 404);
            }

            $updated = $this->devoirRepository->update($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Devoir mis à jour avec succès.',
                'data' => $updated
            ]);
        } catch (Exception $e) {
            Log::error('Erreur update Devoir : ' . $e->getMessage());
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
            $devoir = $this->devoirRepository->findById($id);

            if (!$devoir) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Devoir non trouvé.'
                ], 404);
            }

            $this->devoirRepository->delete($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Devoir supprimé avec succès.'
            ]);
        } catch (Exception $e) {
            Log::error('Erreur destroy Devoir : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression.'
            ], 500);
        }
    }
}

