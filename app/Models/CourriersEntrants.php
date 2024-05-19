<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourriersEntrants extends Model
{
    use HasFactory;
    protected $fillable=[
        'Reference',
        'Expediteur',
        'NumeroInscriptionAcademie',
        'DateInscriptionAcademie',
        'NumeroEnvoiEntiteExpeditrice',
        'DateEnvoiEntiteExpeditrice',
        'CorrespondanceRequiertReponse',
        'Repondu',
        'DernierDelaiReponse',
        'SujetCorrespondance',
        'TelechargementCorrespondance',
        'Statut'
        
    ];
}
