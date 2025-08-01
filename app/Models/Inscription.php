<?php

namespace App\Models\Comptabilite;

use App\Types\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
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


        'eleve_id',
        'cycle_id',
        'niveau_id',
        'classe_id',
        'annee_id',
        'date_inscription',
        'statut',


        'etat',

    ];



    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }


    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }


     public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }


    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

     public function annee()
    {
        return $this->belongsTo(Annee::class);
    }

public function notes()
{
    return $this->hasMany(Note::class);
}


}
