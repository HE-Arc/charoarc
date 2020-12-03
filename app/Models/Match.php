<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id1',
        'user_id2',
        'status_user1',
        'status_user2'
    ];

    public static function allMatch()
    {
        return Match::all();
    }  
    public static function getMatchById($id){
        return Match::find($id);
    }
    public static function setUser1($id,$idUser){
        $m=Match::getMatchById($id);
        $m->user_id1=$idUser;
        $m->save();
    }
    public static function setStatusUser1($id,$bool){
        $m=Match::getMatchById($id);
        $m->status_user1=$bool;
        $m->save();
    }
    public static function setUser2($id,$idUser){
        $m=Match::getMatchById($id);
        $m->user_id2=$idUser;
        $m->save();
    }
    public static function setStatusUser2($id,$bool){
        $m=Match::getMatchById($id);
        $m->status_user2=$bool;
        $m->save();
    }

}
