<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

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
        'status_user2',
        'has_been_detail_id1',
        'has_been_detail_id2',
        'is_done',
    ];

    public function toString(){
        return  'user_id1 : '.$this->user_id1.' user_id2 : '.$this->user_id2.' status_user1 : '.$this->status_user1.' status_user2 : '.$this->status_user2.' is_done : '.$this->is_done;
    }

    public static function asHtmlTableRowAll($userMatchs){
        $colValidated=collect([]);
        $colPending=collect([]);
        $colAborted=collect([]);
        foreach($userMatchs as $m){
            if($m->toBeDisplayed(Auth::id())){
                switch($m->getMatchTextStatus()){
                    case 'Match Validated':
                        $colValidated->push($m);
                        break;
                    case 'Pending Match':
                        $colPending->push($m);
                        break;
                    case 'Match Aborted':
                        $colAborted->push($m);
                        break;       
                }

            }
        }
        
        $colA=collect([$colValidated,$colPending,$colAborted]);
        $colAll=collect([]);

        $func =  function ($a, $b) {
            if ($a->updated_at == $b->updated_at) {
                return 0;
            }
            return ($a->updated_at > $b->updated_at) ? -1 : 1;
        };

        foreach($colA as $c){
            $colAll->push($c->sort($func));
        }

        $data=collect([]);
        $index=0;

        foreach($colAll as $c){
            switch($index){
                case 0 : 
                    $val='Show already validate Matchs';break;
                case 1 : 
                    $val='Show pending Matchs';break;
                case 2 : 
                    $val='Show aborted Matchs';break;             
            }
            $data->push('
            <tbody>
            <td class="bg-gray-300"colspan="3">
					<label for="namerow'.$index.'">'.$val.'</label>
					<input style="display:none; "type="checkbox" name="namerow'.$index.'" id="namerow'.$index.'" data-toggle="toggle">
            </td>
            </tbody>
            <tbody class="hide" style="display:none">');
            foreach($c as $cIn){
                $style='';
                if($cIn->user_id2 == Auth::id() && !$cIn->has_been_detail_id2){
                    $style=' padding: 1em;
                    border: 5px solid #ffffff;
                    border-radius: 10px;';
                    $cIn->has_been_detail_id2=true;
                }
                else if($cIn->user_id1 == Auth::id() && !$cIn->has_been_detail_id1){
                    $style=' padding: 1em;
                    border: 5px solid #ffffff;
                    border-radius: 10px;';
                    $cIn->has_been_detail_id1=true;
                }
                
                $data->push($cIn->asHtmlTableRowColor($cIn,$index,$style));
            }
            $data->push('</tbody>');
            $index++;
        }
        return implode('',$data->toArray());
    }

    public  function asHtmlTableRowColor($singleMatch,$colorId,$style){
        switch($colorId){
            case 0 :$color='#02b030';
                break;
            case 1:$color='#d68e09';
                break;
            case 2 :$color='#cc493f';
                break;
        }
        if($singleMatch->toBeDisplayed(Auth::id()))
             if($singleMatch->is_done && $singleMatch->status_user1 && $singleMatch->status_user2)
                 return  '
                 <tr style="background-color:'.$color.';'.$style.'" class="py-3 p-6 border-b border-gray-200 overflow-hidden shadow-md sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-6">
                 <td>'.$singleMatch->getUserNameTargetFromIdLogged(Auth::id()).'</td>
                 <td>'.$singleMatch->getMatchTextStatus().' on '.$singleMatch->updated_at.'</td>
                 <td>        
                     <form method="POST" action="'.route('details').'">
                         <input type="hidden" name="_token" value="'.csrf_token().'" />
                         <input type="hidden" name="matchId" value="'.$singleMatch->id.'"></input>
                         <input type ="submit" value="Details" class="bg-gray-400 " style=" border-radius: 9px;" ></input>
                     </form>
                 </td>
                 </tr>';
             else
                 return  '
                 <tr  style="background-color:'.$color.'" class="py-3 p-6 border-b border-gray-200 overflow-hidden shadow-md sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-6">
                 <td>'.$singleMatch->getUserNameTargetFromIdLogged(Auth::id()).'</td>
                 <td>'.$singleMatch->getMatchTextStatus().' on '.$singleMatch->updated_at.'</td><td></td>
                 </tr>';
     }

    public function getUserNameTargetFromIdLogged($userId){
        if($userId==$this->user_id2)
            return User::getUserById($this->user_id1)->name;
        if($userId==$this->user_id1)
            return User::getUserById($this->user_id2)->name;
    }
    public function getUserTargetFromIdLogged($userId){
        if($userId==$this->user_id2)
            return User::getUserById($this->user_id1);
        if($userId==$this->user_id1)
            return User::getUserById($this->user_id2);
    }

    public function toBeDisplayed($currentUserId){
        return(($currentUserId== $this->user_id1 && $this->status_user1 == true) || ( $currentUserId== $this->user_id2 && $this->status_user2 == true));
    }

    public function getTargetUserId($userId){
        if($userId==$this->user_id2)
            return $this->user_id1;
        if($userId==$this->user_id1)
            return $this->user_id2;
    }
    
    public function getTargetImage($userId){
        if($userId==$this->user_id2)
            return User::getUserById($this->user_id1);
        if($userId==$this->user_id1)
            return User::getUserById($this->user_id2);

    }

    public  function getMatchTextStatus(){
        if($this->status_user2==1 && $this->status_user1==1 && $this->is_done==1)
            return 'Match Validated';
        if($this->is_done==1 && ($this->status_user2==0 || $this->status_user1==0))
            return 'Match Aborted';
        return 'Pending Match';
    } 

    //static

    public static function updateNotif($matchId){
        $m=Match::getMatchById($matchId);
        if($m->user_id2 == Auth::id() && !$m->has_been_detail_id2){
            $m->has_been_detail_id2=true;
        }
        else if($m->user_id1 == Auth::id() && !$m->has_been_detail_id1){
            $m->has_been_detail_id1=true;
        }
        $m->save();
    }


    public static function updateByLikeOrDislike($matchId,$status){
        $m=Match::getMatchById($matchId);
        if( $m->user_id1==Auth::id()){
            //cas on est l utilisateur est id1
            $m->status_user1=$status;
        }else{
            //cas utilisateur est id2
            $m->status_user2=$status;
        }
        $m->is_done=true;
        $m->save();
    }

    public static function createAndStore($newMatchUserId,$status){
        $newMatch=new Match();        
        $newMatch->user_id1=Auth::id();
        $newMatch->user_id2=$newMatchUserId;
        $newMatch->status_user1=$status;
        $newMatch->status_user2=false;
        $newMatch->has_been_detail_id1=false;
        $newMatch->has_been_detail_id2=false;
        $newMatch->is_done=!$status;
        $newMatch->save();
    }
    public static function findATarget(){
        $id=Auth::id();
        $userMe=User::getUserById($id);
        $userMatchs=Match::getAllMatchByUser($id);
        $matchsToAnswer=[];
        $indexMatchsToAnswer=0;
        $oneMatchToAnswer=null;
        $newMatchUserId=null;

        foreach($userMatchs as $m){
            if($m->user_id1==$id){
                $user2=User::getUserById($m->user_id2);
                //cas on est user 1
                if($m->status_user1 == false && $m->is_done==false){
                    //on n'a pas encore voté on propose donc le match si respect regles
                    if($userMe->gender== $user2->interessedBy && $user2->gender== $userMe->interessedBy){
                        //on correspond
                        $matchsToAnswer[$indexMatchsToAnswer++]=$m;
                    }
                    else{
                        $m->is_done=true;
                    }
                }
            }
            else if($m->user_id2==$id){
                $user1=User::getUserById($m->user_id1);
                //cas on est user 2
                if($m->status_user2 == false && $m->is_done==false){
                    //on n'a pas encore voté on propose donc le match si respect regles
                    if($userMe->gender== $user1->interessedBy && $user1->gender== $userMe->interessedBy){
                        //on correspond
                        $matchsToAnswer[$indexMatchsToAnswer++]=$m;
                    }
                    else{
                        $m->is_done=true;
                    }
                }
            }
        }
        if($indexMatchsToAnswer>0){
            //on peut avoir un match a répondre
            //on choisit donc un match dans la liste
            $oneMatchToAnswer=$matchsToAnswer[random_int(0,$indexMatchsToAnswer-1)];
        }
        else{
            //pas de matchs, il faut proposer un nouveau
            $possibleUsersToMatchWith=[];
            $indexPossibleMatchs=0;
            foreach(User::allUser() as $userTargeted){
                if($userMe->interessedBy == $userTargeted->gender && $userMe!=$userTargeted && $userTargeted->interessedBy == $userMe->gender ){
                    $bool=true;
                    foreach(Match::getAllMatchByUser($id) as $m){
                        if(($userTargeted->id==$m->user_id1 && $id==$m->user_id2) || ($userTargeted->id==$m->user_id2 && $id==$m->user_id1))
                            $bool = false;
                    }
                    if($bool)
                        $possibleUsersToMatchWith[$indexPossibleMatchs++]=$userTargeted;
                }
            }
            if($indexPossibleMatchs>0){
                $newMatchUserId=$possibleUsersToMatchWith[random_int(0,$indexPossibleMatchs-1)]->id;
             }
        }
     
        $image='defaultUser.jpg';
        $idToSend=null;
        $name=null;
        if($oneMatchToAnswer!=null){//cas match existant
            $image=$oneMatchToAnswer->getTargetImage($id)->image!=null?$oneMatchToAnswer->getTargetImage($id)->image:'defaultUser.jpg';
            $idToSend=$oneMatchToAnswer->id;
            $name=Match::getMatchById($idToSend)->getUserNameTargetFromIdLogged($id);
        }
        else if($newMatchUserId!=null){//cas creation possible d'un futur match
            $image=User::getUserById($newMatchUserId)->image!=null? User::getUserById($newMatchUserId)->image : 'defaultUser.jpg';
            $name=User::getUserById($newMatchUserId)->name;
        }

        //for debug ONLY TOBEREMOVED
        if($oneMatchToAnswer!=null && false){
             //fordebug
             $oneMatchToAnswer=new Match();
             $oneMatchToAnswer->user_id1=$id;
             $oneMatchToAnswer->user_id2=$newMatchUserId;
             $oneMatchToAnswer->status_user1=false;
             $oneMatchToAnswer->status_user2=false;
             $oneMatchToAnswer->is_done=false;
            echo "<br><br><br>";
            echo $oneMatchToAnswer->toString();
        }

        return Collect([$userMatchs,$idToSend,$newMatchUserId,$image,$name]);
    }


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
