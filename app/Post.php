<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    
    protected $table= 'posts';
    public $primaryKey='id';
    public $timestamps =true;

    public function user(){
        return $this->belongsTo('App\User');
       
        return $this->hasMany('App\Player','id','idteam');
    }
    public function sports(){

        return $this->belongsTo('App\Sport','idsport','idsport');
       
    }
}