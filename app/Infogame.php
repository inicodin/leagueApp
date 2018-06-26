<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infogame extends Model
{
    protected $table= 'infogames';
    public $primaryKey='idinfo';
    public $timestamps =false;

    public function game(){
        return $this->belongsTo('App\Game','idgame','idgame');
    }
    public function team(){
        return $this->belongsTo('App\Post','id','idteam');
    }
    public function player(){
        return $this->belongsTo('App\Player','idplayer','idplayer');
    }
}
