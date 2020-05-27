<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model 
{
    protected $fillable = [
        'cne','user_id','filiere_id','date_inscription'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function filiere()
    {
        return $this->belongsTo('App\Filiere');
    }

    public function getcne(){
        return $this->cne;
    }
}