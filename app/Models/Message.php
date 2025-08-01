<?php

namespace App\Models\Comptabilite;

use App\Types\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
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


        'expediteur_id',
        'destinataire_id',
        'objet',
        'contenu',
        'lu',
       

        'etat',

    ];



    public function expediteur()
    {
        return $this->belongsTo(Utilisateur::class);
    }


    public function destinataire()
    {
        return $this->belongsTo(Utilisateur::class);
    }



    
    

}
