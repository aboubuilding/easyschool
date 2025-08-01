<?php
namespace App\Repositories;

use App\Models\Message;
use App\Repositories\Interfaces\MessageRepositoryInterface;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    public function __construct(Message $message)
    {
        $this->model = $message;
    }
}
