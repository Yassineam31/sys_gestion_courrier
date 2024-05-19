<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourriersSortants extends Model
{
    use HasFactory;
    protected $fillable=[
        'Reference',
        'Destinataire',
        'NumeroEnvoiAcademie',
        'DateEnvoiAcademie',
        'ObjetCorrespondance',
        'CorrespondanceRequiertReponse',
        'DernierDelaiReceptionReponse',
        'ReponseRecue',
        'TelechargementCorrespondance',
        'Statut'
        
    ];
}
