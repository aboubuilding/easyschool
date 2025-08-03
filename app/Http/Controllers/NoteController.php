<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Repositories\Contracts\NoteRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class NoteController extends Controller
{
    protected  $noteRepository;

    public function __construct(NoteRepositoryInterface  $noteRepository)
    {
        $this->noteRepository =  $noteRepository;
    }

    // Vue HTML
    public function index()
    {
        try {
             $notes = $this->noteRepository->all();
            return view('Notes.index', compact('Notes'));
        } catch (Exception $e) {
            Log::error('Erreur lors de l affichage des Notes : ' . $e->getNote());
            return back()->with('error', 'Une erreur est survenue.');
        }
    }

    // Création
    public function store(NoteRequest $request)
    {
        try {
             $note = $this->noteRepository->create($request->validated());

            return response()->json([
                'status' => 'success',
                'Note' => 'Note ajouté avec succès.',
                'data' =>  $note
            ]);
        } catch (Exception $e) {
            Log::error('Erreur store Note : ' . $e->getNote());
            return response()->json([
                'status' => 'error',
                'Note' => 'Erreur lors de l enregistrement du Note.'
            ], 500);
        }
    }

    // Afficher pour modification
    public function show($id)
    {
        try {
             $note = $this->noteRepository->findById($id);

            if (! $note) {
                return response()->json([
                    'status' => 'error',
                    'Note' => 'Note introuvable.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' =>  $note
            ]);
        } catch (Exception $e) {
            Log::error('Erreur show Note : ' . $e->getNote());
            return response()->json([
                'status' => 'error',
                'Note' => 'Erreur lors de la récupération.'
            ], 500);
        }
    }

    // Mise à jour
    public function update(NoteRequest $request, $id)
    {
        try {
             $note = $this->noteRepository->findById($id);

            if (! $note) {
                return response()->json([
                    'status' => 'error',
                    'Note' => 'Note non trouvé.'
                ], 404);
            }

            $updated = $this->noteRepository->update($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'Note' => 'Note mis à jour avec succès.',
                'data' => $updated
            ]);
        } catch (Exception $e) {
            Log::error('Erreur update Note : ' . $e->getNote());
            return response()->json([
                'status' => 'error',
                'Note' => 'Échec de la mise à jour.'
            ], 500);
        }
    }

    // Suppression
    public function destroy($id)
    {
        try {
             $note = $this->noteRepository->findById($id);

            if (! $note) {
                return response()->json([
                    'status' => 'error',
                    'Note' => 'Note non trouvé.'
                ], 404);
            }

            $this->noteRepository->delete($id);

            return response()->json([
                'status' => 'success',
                'Note' => 'Note supprimé avec succès.'
            ]);
        } catch (Exception $e) {
            Log::error('Erreur destroy Note : ' . $e->getNote());
            return response()->json([
                'status' => 'error',
                'Note' => 'Erreur lors de la suppression.'
            ], 500);
        }
    }
}

