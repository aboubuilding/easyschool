<?php
namespace App\Repositories;

use App\Models\Log;
use App\Repositories\Interfaces\LogRepositoryInterface;

class LogRepository extends BaseRepository implements LogRepositoryInterface
{
    public function __construct(Log $log)
    {
        $this->model = $log;
    }
}
