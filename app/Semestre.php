<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model 
{
    protected $fillable = [
        'name'
    ];

    public function modules()
    {
        return $this->hasMany('App\Module');
    }

    public function __toString(){
        return ( $this->id ) ? $this->name : "";
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('semestre',$this->name).'" target="_blank">'.$this->name.'</a>' : "";
    }

    public function getname(){
        return $this->name;
    }
}
