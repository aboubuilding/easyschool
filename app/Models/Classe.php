<?php

namespace App\Models\Comptabilite;

use App\Types\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
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
        'cycle_id',
        'niveau_id',

        'annee_id',


        'etat',

    ];


    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }


    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

     public function annee()
    {
        return $this->belongsTo(Annee::class);
    }

public function devoirs()
{
    return $this->hasMany(Devoir::class);
}


}
