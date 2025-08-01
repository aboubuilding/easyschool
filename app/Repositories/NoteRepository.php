<?php
namespace App\Repositories;

use App\Models\Note;
use App\Repositories\Interfaces\NoteRepositoryInterface;

class NoteRepository extends BaseRepository implements NoteRepositoryInterface
{
    public function __construct(Note $note)
    {
        $this->model = $note;
    }
}
