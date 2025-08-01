<?php
namespace App\Repositories;

use App\Models\Devoir;
use App\Repositories\Interfaces\DevoirRepositoryInterface;

class DevoirRepository extends BaseRepository implements DevoirRepositoryInterface
{
    public function __construct(Devoir $devoir)
    {
        $this->model = $devoir;
    }
}
