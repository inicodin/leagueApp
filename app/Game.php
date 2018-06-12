<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table= 'games';
    public $primaryKey='idgame';
    public $timestamps =true;

    public function gameteam1(){
        return $this->belongsTo('App\Post','idteam1','id');
    }
    public function gameteam2(){
        return $this->belongsTo('App\Post','idteam2','id');
    }
    public function gamesport(){
        return $this->belongsTo('App\Sport','idsport','idsport');
    }
}
