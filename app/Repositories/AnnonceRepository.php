<?php
namespace App\Repositories;

use App\Models\Annonce;
use App\Repositories\Interfaces\AnnonceRepositoryInterface;

class AnnonceRepository extends BaseRepository implements AnnonceRepositoryInterface
{
    public function __construct(Annonce $annonce)
    {
        $this->model = $annonce;
    }
}
