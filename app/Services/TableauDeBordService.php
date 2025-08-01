<?php

namespace App\Services;

use App\Models\Eleve;
use App\Models\Enseignant;
use App\Models\Classe;
use App\Models\Absence;
use App\Models\Note;
use App\Models\Annonce;
use App\Models\Devoir;
use App\Models\Inscription;
use Illuminate\Support\Carbon;

class TableauDeBordService
{
    public function getDonnees()
    {
        $today = Carbon::today();

        return [
            'nb_eleves' => Eleve::where('etat', 1)->count(),
            'nb_enseignants' => Enseignant::where('etat', 1)->count(), // ✅ MAJ ici
            'nb_classes' => Classe::where('etat', 1)->count(),
            'nb_absences_auj' => Absence::whereDate('date_absence', $today)->count(),
            'nb_notes' => Note::count(),
            'nb_devoirs_auj' => Devoir::whereDate('date_rendu', $today)->count(),
            'nb_annonces' => Annonce::whereDate('date_publication', $today)->count(),
            'nb_inscriptions' => Inscription::count(),
        ];
    }

    public function getAlertes()
    {
        return [
            'eleves_sans_notes' => Eleve::doesntHave('notes')->count(),
            'absences_non_justifiees' => Absence::where('justifiee', false)->count(),
            'classes_sans_devoirs' => Classe::whereDoesntHave('devoirs')->count(),
        ];
    }
}
