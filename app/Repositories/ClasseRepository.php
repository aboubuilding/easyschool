<?php
namespace App\Repositories;

use App\Models\Classe;
use App\Repositories\Interfaces\ClasseRepositoryInterface;

class ClasseRepository extends BaseRepository implements ClasseRepositoryInterface
{
    public function __construct(Eleve $classe)
    {
        $this->model = $classe;
    }
}
