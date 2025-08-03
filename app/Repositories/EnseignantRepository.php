<?php
namespace App\Repositories;

use App\Models\Enseignant;
use App\Repositories\Interfaces\EnseignantRepositoryInterface;

class EnseignantRepository extends BaseRepository implements EnseignantRepositoryInterface
{
    public function __construct(Enseignant $enseignant)
    {
        $this->model = $enseignant;
    }


    public function listeActifs(): Collection
    {
        return Enseignant::where('etat', 1)
            ->orderBy('nom')
            ->get();
    }
}
