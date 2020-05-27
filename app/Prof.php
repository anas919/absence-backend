<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prof extends Model 
{
    protected $fillable = [
        'matricule','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function modules()
    {
        return $this->belongsToMany('App\Module');
    }

    public function seances()
    {
        return $this->hasMany('App\Seance');
    }

    public function getmatricule(){
        return $this->matricule;
    }
}