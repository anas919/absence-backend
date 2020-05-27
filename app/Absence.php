<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model 
{
    protected $fillable = [
        'etudiant_id','seance_id','justification','fichier','casser'
    ];

    public function etudiant()
    {
        return $this->belongsTo('App\Etudiant');
    }

    public function seance()
    {
        return $this->belongsTo('App\Seance');
    }

    public function getjustification(){
        return $this->justification;
    }

    public function getetudiant(){
        return $this->etudiant ? $this->etudiant->user->name : null;
    }

    public function getseance(){
        return $this->seance ? $this->seance->date : null;
    }
}
