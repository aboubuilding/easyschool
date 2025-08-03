<?php

namespace App\Models\Comptabilite;

use App\Types\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasFactory;

    public function __construct(array $attributes=[])
    {
        parent::__construct($attributes);
        $this->etat=TypeStatus::ACTIF;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [


        'nom',
        
        'etat',

    ];


    public function niveaux()
{
    return $this->hasMany(Niveau::class);
}

public function classes()
{
    return $this->hasManyThrough(Classe::class, Niveau::class);
}

public function inscriptions()
{
    return $this->hasManyThrough(Inscription::class, Classe::class, 'niveau_id', 'classe_id');
}


}
