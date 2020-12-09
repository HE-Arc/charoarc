<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;


    protected $table='matchs';//to fix issue with select * from matches

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

    public function getUserNameFromId($userId){
        if($userId==$this->user_id2)
            return User::getUserById($this->user_id1)->name;
        if($userId==$this->user_id1)
            return User::getUserById($this->user_id2)->name;
    }

    public  function getMatchStatus(){
        if($this->status_user2==1)
            return 'Match Validated';
        return 'Pending Match';
    } 

    //static

    public static function allMatchs()
    {
        return Match::all();
    }  
    public static function getMatchById($id){
        return Match::find($id);
    }
    public static function getAllMatchByUser($userId){
        $allMatchs=Match::allMatchs();
        $stock=[];
        $var=0;
        foreach($allMatchs as $m){
            if($m->user_id1==$userId || $m->user_id2==$userId ){
                $stock[$var++]=$m;       
            }
        }
        return $stock;
    }
}
