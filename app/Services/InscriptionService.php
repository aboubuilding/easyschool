<?php

namespace App\Services;

use App\Models\Eleve;
use App\Models\Inscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class InscriptionService
{


public function listerInscriptions(array $filtres = [])
{
    $query = Inscription::with(['eleve', 'classe', 'niveau', 'cycle', 'annee'])
        ->where('etat', 1);

    if (!empty($filtres['annee_id'])) {
        $query->where('annee_id', $filtres['annee_id']);
    }

    if (!empty($filtres['cycle_id'])) {
        $query->where('cycle_id', $filtres['cycle_id']);
    }

    if (!empty($filtres['niveau_id'])) {
        $query->where('niveau_id', $filtres['niveau_id']);
    }

    if (!empty($filtres['classe_id'])) {
        $query->where('classe_id', $filtres['classe_id']);
    }

    $inscriptions = $query->get();

    return $inscriptions->map(function ($inscription) {
        $eleve = $inscription->eleve;

        return [
            'photo' => $eleve->photo
                ? asset('storage/photos/' . $eleve->photo)
                : asset('images/default-avatar.png'),

            'matricule' => $eleve->matricule,
            'nom_complet' => trim("{$eleve->nom} {$eleve->prenom}"),
            'classe' => $inscription->classe->nom ?? '-',
            'cycle' => $inscription->cycle->nom ?? '-',
            'niveau' => $inscription->niveau->nom ?? '-',
            'annee' => $inscription->annee->nom ?? '-',
            'age' => $eleve->date_naissance
                ? Carbon::parse($eleve->date_naissance)->age
                : 'N/A',
            'sexe' => $eleve->sexe === 1 ? 'Masculin' : ($eleve->sexe === 0 ? 'Féminin' : 'Non défini'),
            'date_inscription' => $inscription->date_inscription?->format('d/m/Y'),
        ];
    });
}
    /**
     * Créer une nouvelle inscription avec l'élève associé
     */
    public function enregistrer(array $data): Inscription
    {
        return DB::transaction(function () use ($data) {
            $eleve = Eleve::create([
                'matricule' => $data['matricule'],
                'nom' => $data['nom'],
                'prenom' => $data['prenom'] ?? null,
                'date_naissance' => $data['date_naissance'] ?? null,
                'lieu_naissance' => $data['lieu_naissance'] ?? null,
                'sexe' => $data['sexe'] ?? null,
                'photo' => $data['photo'] ?? null,
                'parent_id' => $data['parent_id'] ?? null,
                'etat' => $data['etat'] ?? 1,
            ]);

            return $eleve->inscriptions()->create([
                'cycle_id' => $data['cycle_id'] ?? null,
                'niveau_id' => $data['niveau_id'] ?? null,
                'classe_id' => $data['classe_id'] ?? null,
                'annee_id' => $data['annee_id'],
                'date_inscription' => $data['date_inscription'] ?? now(),
                'statut' => $data['statut'] ?? 1,
                'etat' => $data['inscription_etat'] ?? 1,
            ]);
        });
    }

    /**
     * Met à jour une inscription et les infos élève associées
     */
    public function modifier(Inscription $inscription, array $data): Inscription
    {
        return DB::transaction(function () use ($inscription, $data) {
            $eleve = $inscription->eleve;

            $eleve->update([
                'matricule' => $data['matricule'],
                'nom' => $data['nom'],
                'prenom' => $data['prenom'] ?? null,
                'date_naissance' => $data['date_naissance'] ?? null,
                'lieu_naissance' => $data['lieu_naissance'] ?? null,
                'sexe' => $data['sexe'] ?? null,
                'photo' => $data['photo'] ?? null,
                'parent_id' => $data['parent_id'] ?? null,
                'etat' => $data['etat'] ?? 1,
            ]);

            $inscription->update([
                'cycle_id' => $data['cycle_id'] ?? null,
                'niveau_id' => $data['niveau_id'] ?? null,
                'classe_id' => $data['classe_id'] ?? null,
                'annee_id' => $data['annee_id'],
                'date_inscription' => $data['date_inscription'] ?? now(),
                'statut' => $data['statut'] ?? 1,
                'etat' => $data['inscription_etat'] ?? 1,
            ]);

            return $inscription;
        });
    }

    /**
     * Retourne les statistiques globales des inscriptions
     */
    public function stats(): array
{
    return [
        'total' => Inscription::count(),

        'actives' => Inscription::where('etat', 1)->count(),

        'du_jour' => Inscription::whereDate('date_inscription', now())->count(),

        'par_annee' => Inscription::selectRaw('annee_id, COUNT(*) as total')
            ->groupBy('annee_id')
            ->get()
            ->pluck('total', 'annee_id'),

        'par_cycle' => Inscription::selectRaw('cycle_id, COUNT(*) as total')
            ->groupBy('cycle_id')
            ->get()
            ->pluck('total', 'cycle_id'),

        'par_niveau' => Inscription::selectRaw('niveau_id, COUNT(*) as total')
            ->groupBy('niveau_id')
            ->get()
            ->pluck('total', 'niveau_id'),

        'par_classe' => Inscription::selectRaw('classe_id, COUNT(*) as total')
            ->groupBy('classe_id')
            ->get()
            ->pluck('total', 'classe_id'),

        'par_statut' => Inscription::selectRaw('statut, COUNT(*) as total')
            ->groupBy('statut')
            ->get()
            ->pluck('total', 'statut'),

        // 🧠 Inscriptions par sexe des élèves
        'par_sexe' => Inscription::join('eleves', 'inscriptions.eleve_id', '=', 'eleves.id')
            ->selectRaw('eleves.sexe, COUNT(*) as total')
            ->groupBy('eleves.sexe')
            ->get()
            ->pluck('total', 'eleves.sexe'),

        // 🧠 Inscriptions par date (7 derniers jours)
        'par_date_7j' => Inscription::selectRaw('DATE(date_inscription) as date, COUNT(*) as total')
            ->whereDate('date_inscription', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date'),
    ];
}

}
