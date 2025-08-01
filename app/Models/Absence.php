<?php

namespace App\Models\Comptabilite;

use App\Types\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
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
        'date_absence',
        'heure_absence',
        
        'retard',
        'motif',
        'justifiee',


        'etat',

    ];



    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }


    

}
