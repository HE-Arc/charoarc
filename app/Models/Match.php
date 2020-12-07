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

    private $name1;
    private $name2;   

    public function getName1(){
        return $this->name1;
    }
    public function getName2(){
        return $this->name2;
    }

    public static function allMatchs()
    {
        return Match::all();
    }  
    public static function getMatchById($id){
        return Match::find($id);
    }
    public static function getAllMatchByUser($userId){
        $user = User::getUserById($userId);
        $allMatchs=Match::allMatchs();
        $stock=[];
        $var=0;
        foreach($allMatchs as $m){
            if($m->user_id1==$userId || $m->user_id2==$userId ){
                $stock[$var++]=$m;
                $m->name1=$user->name;
                $m->name2=User::getUserById($m->user_id2)->name;
            }
        }
        return $stock;
        
        //return Match::where('user_id1'==$userId || 'user_id2'==$userId );
    }
    
    public  function getMatchStatus(){
        if($this->status_user2==1)
            return 'Match Validated';
        return 'Pending Match';
    } 

}
