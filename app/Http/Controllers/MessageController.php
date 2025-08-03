<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Repositories\Contracts\MessageRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class MessageController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    // Vue HTML
    public function index()
    {
        try {
            $messages = $this->messageRepository->all();
            return view('Messages.index', compact('Messages'));
        } catch (Exception $e) {
            Log::error('Erreur lors de l affichage des Messages : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue.');
        }
    }

    // Création
    public function store(MessageRequest $request)
    {
        try {
            $message = $this->messageRepository->create($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Message ajouté avec succès.',
                'data' => $message
            ]);
        } catch (Exception $e) {
            Log::error('Erreur store Message : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de l enregistrement du Message.'
            ], 500);
        }
    }

    // Afficher pour modification
    public function show($id)
    {
        try {
            $message = $this->messageRepository->findById($id);

            if (!$message) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Message introuvable.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $message
            ]);
        } catch (Exception $e) {
            Log::error('Erreur show Message : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération.'
            ], 500);
        }
    }

    // Mise à jour
    public function update(MessageRequest $request, $id)
    {
        try {
            $message = $this->messageRepository->findById($id);

            if (!$message) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Message non trouvé.'
                ], 404);
            }

            $updated = $this->messageRepository->update($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Message mis à jour avec succès.',
                'data' => $updated
            ]);
        } catch (Exception $e) {
            Log::error('Erreur update Message : ' . $e->getMessage());
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
            $message = $this->messageRepository->findById($id);

            if (!$message) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Message non trouvé.'
                ], 404);
            }

            $this->messageRepository->delete($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Message supprimé avec succès.'
            ]);
        } catch (Exception $e) {
            Log::error('Erreur destroy Message : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression.'
            ], 500);
        }
    }
}

