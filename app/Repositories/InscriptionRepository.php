<?php
namespace App\Repositories;

use App\Models\Inscription;
use App\Repositories\Interfaces\InscriptionRepositoryInterface;

class InscriptionRepository extends BaseRepository implements InscriptionRepositoryInterface
{
    public function __construct(Inscription $inscription)
    {
        $this->model = $inscription;
    }
}
