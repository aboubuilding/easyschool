<?php
namespace App\Repositories;

use App\Models\Parent;
use App\Repositories\Interfaces\ParentRepositoryInterface;

class ParentRepository extends BaseRepository implements ParentRepositoryInterface
{
    public function __construct(Parent $parent)
    {
        $this->model = $parent;
    }
}
