<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model 
{
    protected $fillable = [
        'name','ref','description','filiere_id','semestre_id'
    ];

    public function __toString(){
        return ( $this->id ) ? $this->name : "";
    }

    public function semestre()
    {
        return $this->belongsTo('App\Semestre');
    }

    public function filiere()
    {
        return $this->belongsTo('App\Filiere');
    }

    public function profs()
    {
        return $this->belongsToMany('App\Prof');
    }

    public function seances()
    {
        return $this->hasMany('App\Seance');
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('module',$this->ref).'" target="_blank">'.$this->name.'</a>' : "";
    }

    public function getname(){
        return $this->name;
    }
    
    public function getdescription(){
        return $this->description;
    }
    
    public function getref(){
        return $this->ref;
    }
    
}
