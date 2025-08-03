<?php
namespace App\Repositories;

use App\Models\Classe;
use App\Repositories\Interfaces\ClasseRepositoryInterface;
use Illuminate\Support\Collection;

class ClasseRepository extends BaseRepository implements ClasseRepositoryInterface
{
    public function __construct(Eleve $classe)
    {
        $this->model = $classe;
    }

    public function liste(): Collection
    {
        return Classe::with([
                'cycle:id,nom',
                'niveau:id,nom'
            ])
            ->withCount('inscriptions')
            ->where('etat', 1)
            ->orderBy('nom')
            ->get();
    }
}
