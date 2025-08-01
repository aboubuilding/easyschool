<?php

namespace App\Models\Comptabilite;

use App\Types\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    public function __construct(array $attributes=[])
    {
        Utilisateur::__construct($attributes);
        $this->etat=TypeStatus::ACTIF;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [


        'nom',
        'prenom',
        'email',
        'password',
        'role_id',
        
       
        'etat',

    ];



    public function role()
    {
        return $this->belongsTo(Role::class);
    }


   
    
    

}
