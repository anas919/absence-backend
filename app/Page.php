<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model 
{
    protected $fillable = [
        'title','link','content'
    ];

    public function __toString(){
        return ( $this->id ) ? $this->title : "";
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('page',$this->link).'" target="_blank">'.$this->title.'</a>' : "";
    }

    public function gettitle(){
        return $this->title;
    }
    
    public function getcontenu(){
        return $this->contenu;
    }
    
    public function getlink(){
        return $this->link;
    }
}
