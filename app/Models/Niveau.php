<?php

namespace App\Models\Comptabilite;

use App\Types\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
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
        'annee_id',
        

        'etat',

    ];



    public function cycle()
{
    return $this->belongsTo(Cycle::class);
}

public function classes()
{
    return $this->hasMany(Classe::class);
}

public function inscriptions()
{
    return $this->hasMany(Inscription::class);
}



    
    

}
