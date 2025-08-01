<?php
namespace App\Repositories;

use App\Models\Niveau;
use App\Repositories\Interfaces\NiveauRepositoryInterface;

class NiveauRepository extends BaseRepository implements NiveauRepositoryInterface
{
    public function __construct(Niveau $niveau)
    {
        $this->model = $niveau;
    }
}
