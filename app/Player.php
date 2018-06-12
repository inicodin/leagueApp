<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Post;

class Player extends Model
{
    protected $table= 'players';
    public $primaryKey='idplayer';
    public $timestamps =false;

    public function player(){
        return $this->belongsTo('App\Post','idteam','id');
    }

    public function getAgeAttribute()
{
    return Carbon::parse($this->attributes['birth'])->age;
}
}
