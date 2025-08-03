<?php

namespace App\Http\Controllers;

use App\Http\Requests\UtilisateurRequest;
use App\Repositories\Contracts\UtilisateurRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Exception;

class UtilisateurController extends Controller
{
    protected  $utilisateurRepository;

    public function __construct(UtilisateurRepositoryInterface  $utilisateurRepository)
    {
        $this->utilisateurRepository =  $utilisateurRepository;
    }

    // Vue HTML
    public function index()
    {
        try {
             $utilisateurs = $this->utilisateurRepository->all();
            return view('Utilisateurs.index', compact('Utilisateurs'));
        } catch (Exception $e) {
            Log::error('Erreur lors de l affichage des Utilisateurs : ' . $e->getUtilisateur());
            return back()->with('error', 'Une erreur est survenue.');
        }
    }

    // Création
    public function store(UtilisateurRequest $request)
    {
        try {
             $utilisateur = $this->utilisateurRepository->create($request->validated());

            return response()->json([
                'status' => 'success',
                'Utilisateur' => 'Utilisateur ajouté avec succès.',
                'data' =>  $utilisateur
            ]);
        } catch (Exception $e) {
            Log::error('Erreur store Utilisateur : ' . $e->getUtilisateur());
            return response()->json([
                'status' => 'error',
                'Utilisateur' => 'Erreur lors de l enregistrement du Utilisateur.'
            ], 500);
        }
    }

    // Afficher pour modification
    public function show($id)
    {
        try {
             $utilisateur = $this->utilisateurRepository->findById($id);

            if (! $utilisateur) {
                return response()->json([
                    'status' => 'error',
                    'Utilisateur' => 'Utilisateur introuvable.'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' =>  $utilisateur
            ]);
        } catch (Exception $e) {
            Log::error('Erreur show Utilisateur : ' . $e->getUtilisateur());
            return response()->json([
                'status' => 'error',
                'Utilisateur' => 'Erreur lors de la récupération.'
            ], 500);
        }
    }

    // Mise à jour
    public function update(UtilisateurRequest $request, $id)
    {
        try {
             $utilisateur = $this->utilisateurRepository->findById($id);

            if (! $utilisateur) {
                return response()->json([
                    'status' => 'error',
                    'Utilisateur' => 'Utilisateur non trouvé.'
                ], 404);
            }

            $updated = $this->utilisateurRepository->update($id, $request->validated());

            return response()->json([
                'status' => 'success',
                'Utilisateur' => 'Utilisateur mis à jour avec succès.',
                'data' => $updated
            ]);
        } catch (Exception $e) {
            Log::error('Erreur update Utilisateur : ' . $e->getUtilisateur());
            return response()->json([
                'status' => 'error',
                'Utilisateur' => 'Échec de la mise à jour.'
            ], 500);
        }
    }

    // Suppression
    public function destroy($id)
    {
        try {
             $utilisateur = $this->utilisateurRepository->findById($id);

            if (! $utilisateur) {
                return response()->json([
                    'status' => 'error',
                    'Utilisateur' => 'Utilisateur non trouvé.'
                ], 404);
            }

            $this->utilisateurRepository->delete($id);

            return response()->json([
                'status' => 'success',
                'Utilisateur' => 'Utilisateur supprimé avec succès.'
            ]);
        } catch (Exception $e) {
            Log::error('Erreur destroy Utilisateur : ' . $e->getUtilisateur());
            return response()->json([
                'status' => 'error',
                'Utilisateur' => 'Erreur lors de la suppression.'
            ], 500);
        }
    }
}

