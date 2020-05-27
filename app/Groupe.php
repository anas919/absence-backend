<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model 
{
    protected $fillable = [
        'name','roles'
    ];

    public function __toString(){
        return $this->name;
    }

    public function getname(){
        return $this->name;
    }
    public function getroles(){
        return $this->roles;
    }

    public function users(){
        return $this->hasMany('User','usergroupe','groupe_id');
    }
    
    public function get__roles(){
        return array(
                'Article' => 'المقالات',
                'Cat' => 'تصنيف المقالات',
                'Groupe' => 'المجموعات',
                'User' => 'الأعضاء',
                'Video' => 'الفيديو',
                'Videocat' => 'تصنيف الفيديو',
                'Picture' => 'الصور',
                'Page' => 'الصفحات',
				'Page' => 'الشعب',
            );
    }
}
