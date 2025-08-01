<?php

namespace App\Models\Comptabilite;

use App\Types\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parent extends Model
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


        'nom_parent',
        'prenom_parent',
        'telephone',
        'profession',
        'utilisateur_id',
        
        'adresse',
        'email',
       
        'etat',

    ];



    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }


   
    
    

}
