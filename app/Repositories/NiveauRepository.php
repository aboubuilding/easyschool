<?php
namespace App\Repositories;

use App\Models\Niveau;
use App\Repositories\Interfaces\NiveauRepositoryInterface;
use Illuminate\Support\Collection;

class NiveauRepository extends BaseRepository implements NiveauRepositoryInterface
{
    public function __construct(Niveau $niveau)
    {
        $this->model = $niveau;
    }


    public function listeAvecDetails(): Collection
    {
        return Niveau::with([
                'cycle:id,nom' // On récupère uniquement le nom du cycle
            ])
            ->withCount([
                'classes',
                'inscriptions'
            ])
            ->where('etat', 1) // Seulement les niveaux actifs
            ->orderBy('nom')
            ->get();
    }
}
