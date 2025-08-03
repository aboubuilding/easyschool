<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Repositories\Contracts\ClasseRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class ClasseController extends Controller
{
    protected $classeRepository;

    public function __construct(ClasseRepositoryInterface $classeRepository)
    {
        $this->classeRepository = $classeRepository;
    }

    // Vue HTML
    public function index()
    {
        try {
            $classes = $this->classeRepository->all();
            return view('Classes.index', compact('Classes'));
        } catch (Exception $e) {
            Log::error('Erreur lors de l affichage des Classes : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue.');
        }
    }

    // Création
    public function store(ClasseRequest $request)
    {
        try {
            $classe = $this->classeRepository->create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Classe ajouté avec succès.',
                'data' => $classe
            ]);
        } catch (Exception $e) {
            Log::error('Erreur store Classe : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de l enregistrement du Classe.'
            ], 500);
        }
    }

    // Afficher pour modification
    public function show($id)
    {
        try {
            $classe = $this->classeRepository->findById($id);

            if (!$classe) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Classe introuvable.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $classe
            ]);
        } catch (Exception $e) {
            Log::error('Erreur show Classe : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération.'
            ], 500);
        }
    }

    // Mise à jour
    public function update(ClasseRequest $request, $id)
    {
        try {
            $classe = $this->classeRepository->findById($id);

            if (!$classe) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Classe non trouvé.'
                ], 404);
            }

            $updated = $this->classeRepository->update($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Classe mis à jour avec succès.',
                'data' => $updated
            ]);
        } catch (Exception $e) {
            Log::error('Erreur update Classe : ' . $e->getMessage());
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
            $classe = $this->classeRepository->findById($id);

            if (!$classe) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Classe non trouvé.'
                ], 404);
            }

            $this->classeRepository->delete($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Classe supprimé avec succès.'
            ]);
        } catch (Exception $e) {
            Log::error('Erreur destroy Classe : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression.'
            ], 500);
        }
    }
}

