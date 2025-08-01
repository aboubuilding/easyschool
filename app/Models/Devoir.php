<?php

namespace App\Models\Comptabilite;

use App\Types\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devoir extends Model
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


        'classe_id',
        'matiere_id',
        'enseignant_id',
        
        'contenu',
        'date_rendu',
        'type',


        'etat',

    ];



    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }


    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

     public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }


    

}
