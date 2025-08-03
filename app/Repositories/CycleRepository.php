<?php
namespace App\Repositories;

use App\Models\Cycle;
use App\Repositories\Interfaces\CycleRepositoryInterface;


class CycleRepository extends BaseRepository implements CycleRepositoryInterface
{
    public function __construct(Cycle $cycle)
    {
        $this->model = $cycle;
    }


    public function liste(): Collection
    {
        return Cycle::withCount([
                'niveaux',
                'classes',
                'inscriptions'
            ])
            ->where('etat', 1) // 🔥 Seulement les cycles actifs
            ->orderBy('nom')
            ->get();
    }
}
