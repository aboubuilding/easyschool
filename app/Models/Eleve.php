<?php

namespace App\Models\Comptabilite;

use App\Types\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
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


        'matricule',
        'nom',
        'prenom',
        'utilisateur_id',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'photo',


        'etat',

    ];



    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function parent()
    {
        return $this->belongsTo(Parent::class);
    }


    

}
