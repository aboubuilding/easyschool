<?php

namespace App\Http\Controllers;

use App\Http\Requests\CycleRequest;
use App\Repositories\Contracts\CycleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class CycleController extends Controller
{
    protected $cycleRepository;

    public function __construct(CycleRepositoryInterface $cycleRepository)
    {
        $this->cycleRepository = $cycleRepository;
    }

    // Vue HTML
    public function index()
    {
        try {
            $cycles = $this->cycleRepository->all();
            return view('cycles.index', compact('cycles'));
        } catch (Exception $e) {
            Log::error('Erreur lors de l affichage des cycles : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue.');
        }
    }

    // Création
    public function store(CycleRequest $request)
    {
        try {
            $cycle = $this->cycleRepository->create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Cycle ajouté avec succès.',
                'data' => $cycle
            ]);
        } catch (Exception $e) {
            Log::error('Erreur store cycle : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de l enregistrement du cycle.'
            ], 500);
        }
    }

    // Afficher pour modification
    public function show($id)
    {
        try {
            $cycle = $this->cycleRepository->findById($id);

            if (!$cycle) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cycle introuvable.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $cycle
            ]);
        } catch (Exception $e) {
            Log::error('Erreur show cycle : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération.'
            ], 500);
        }
    }

    // Mise à jour
    public function update(CycleRequest $request, $id)
    {
        try {
            $cycle = $this->cycleRepository->findById($id);

            if (!$cycle) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cycle non trouvé.'
                ], 404);
            }

            $updated = $this->cycleRepository->update($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Cycle mis à jour avec succès.',
                'data' => $updated
            ]);
        } catch (Exception $e) {
            Log::error('Erreur update cycle : ' . $e->getMessage());
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
            $cycle = $this->cycleRepository->findById($id);

            if (!$cycle) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cycle non trouvé.'
                ], 404);
            }

            $this->cycleRepository->delete($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Cycle supprimé avec succès.'
            ]);
        } catch (Exception $e) {
            Log::error('Erreur destroy cycle : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression.'
            ], 500);
        }
    }
}

