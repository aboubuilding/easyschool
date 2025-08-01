<?php

namespace App\Models\Comptabilite;

use App\Types\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
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
        'matiere_id',
        'enseignant_id',
        'devoir_id',
        'valeur',
        'date_note',
        

        'etat',

    ];



    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }


    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

     public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }


     public function devoir()
    {
        return $this->belongsTo(Devoir::class);
    }




    
    

}
