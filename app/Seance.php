<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model 
{
    protected $fillable = [
        'date','prof_id','module_id'
    ];

    public function __toString(){
        return ( $this->id ) ? $this->date : "";
    }

    public function prof()
    {
        return $this->belongsTo('App\Prof');
    }

    public function module()
    {
        return $this->belongsTo('App\Module');
    }

    public function getdate(){
        return $this->date;
    }

    public function getprof(){
        return $this->prof ? $this->prof->user->name : null;
    }

    public function getmodule(){
        return $this->module ? $this->module->name : null;
    }
}
