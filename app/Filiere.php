<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model 
{
    protected $fillable = [
        'name','type','description'
    ];

    public function modules()
    {
        return $this->hasMany('App\Module');
    }

    public function etudiants()
    {
        return $this->hasMany('App\Etudiant');
    }

    public function __toString(){
        return ( $this->id ) ? $this->name : "";
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('filiere',$this->type).'" target="_blank">'.$this->name.'</a>' : "";
    }

    public function getname(){
        return $this->name;
    }
    
    public function getdescription(){
        return $this->description;
    }
    
    public function gettype(){
        return $this->type;
    }
}
