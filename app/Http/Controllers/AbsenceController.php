<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbsenceRequest;
use App\Repositories\Contracts\AbsenceRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class AbsenceController extends Controller
{
    protected $absenceRepository;

    public function __construct(AbsenceRepositoryInterface $absenceRepository)
    {
        $this->absenceRepository = $absenceRepository;
    }

    // Vue HTML
    public function index()
    {
        try {
            $absences = $this->absenceRepository->all();
            return view('absences.index', compact('absences'));
        } catch (Exception $e) {
            Log::error('Erreur lors de l affichage des Absences : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue.');
        }
    }

    // Création
    public function store(AbsenceRequest $request)
    {
        try {
            $absence = $this->absenceRepository->create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Absence ajouté avec succès.',
                'data' => $absence
            ]);
        } catch (Exception $e) {
            Log::error('Erreur store Absence : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de l enregistrement du Absence.'
            ], 500);
        }
    }

    // Afficher pour modification
    public function show($id)
    {
        try {
            $absence = $this->absenceRepository->findById($id);

            if (!$absence) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Absence introuvable.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $absence
            ]);
        } catch (Exception $e) {
            Log::error('Erreur show Absence : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération.'
            ], 500);
        }
    }

    // Mise à jour
    public function update(AbsenceRequest $request, $id)
    {
        try {
            $absence = $this->absenceRepository->findById($id);

            if (!$absence) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Absence non trouvé.'
                ], 404);
            }

            $updated = $this->absenceRepository->update($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Absence mis à jour avec succès.',
                'data' => $updated
            ]);
        } catch (Exception $e) {
            Log::error('Erreur update Absence : ' . $e->getMessage());
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
            $absence = $this->absenceRepository->findById($id);

            if (!$absence) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Absence non trouvé.'
                ], 404);
            }

            $this->absenceRepository->delete($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Absence supprimé avec succès.'
            ]);
        } catch (Exception $e) {
            Log::error('Erreur destroy Absence : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression.'
            ], 500);
        }
    }
}

