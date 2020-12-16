<?php

namespace App\Models;

use Carbon\Carbon;
use Image;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/**
 * Model User 
 */
class User extends Authenticatable  implements MustVerifyEmail
{
    use HasFactory, Notifiable;


    /**
     * const
     * change the min-max age for permissions on the web site
     */
    const MAX_AGE = 100;
    const MIN_AGE = 18;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * return all user
     */
    public static function allUser() {
        $users = User::all();
        return $users;
    }   

    /**
     * get user by id
     * return a user depend on his given id
     */
    public static function getUserById($id) {
        $user = User::find($id);
        return $user;
    }  

    /**
     * Tools
     * return a collection of all
     * users already dislike by loggen user.
     */
    public static function getDislikedUsers() {
        $id=Auth::id();
        $userMatchs=Match::getAllMatchByUser($id);
        $userDisliked=collect([]);

        foreach($userMatchs as $m){
            if($m->user_id1==$id && $m->status_user1==false && $m->is_done==true){
                $userDisliked->push(User::getUserById($m->user_id2));
            }
            else if ($m->user_id2==$id && $m->status_user2==false && $m->is_done==true){
                $userDisliked->push(User::getUserById($m->user_id1));
            }
        }
        return $userDisliked;
    }


    //
    //update management
    //

    /**
     * user name updater
     */
    public static function updateUserName($id, $name) {
        $user = User::find($id);
        $user->name=$name;
        $user->save();
    }
    /**
     * user email updater
     */
    public static function updateUserEmail($id, $email) {
        $user = User::find($id);
        $user->email=$email;
        $user->email_verified_at=null;
        $user->save();
    }
    /**
     * user gender updater
     */
    public static function updateUserGender($id, $gender) {
        $user = User::find($id);
        $user->gender=$gender;
        $user->save();
    }
    /**
     * user interest updater
     */
    public static function updateUserInteressedBy($id, $interessedBy) {
        $user = User::find($id);
        $user->interessedBy=$interessedBy;
        $user->save();
    }
    /**
     * user birthday updater
     */
    public static function updateUserBirthday($id, $birthday) {
        $user = User::find($id);
        $user->birthday=$birthday;
        $user->save();
    }
    /**
     * user description updater
     */
    public static function updateUserDescription($id, $description) {
        $user = User::find($id);
        $user->description=($description);
        $user->save();
    }
    /**
     * user password updater
     */
    public static function updateUserPassword($id, $password) {
        $user = User::find($id);
        $user->password=Hash::make($password);
        $user->save();
    } 
    /**
     * user image updater
     */
    public static function updateUserImage($id, $image) {
        $user = User::find($id);
        $user->image=$image;
        $user->save();
    }
    /**
     * user phone updater
     */
    public static function updatePhone($id,$phone) {
        $user = User::find($id);
        $user->phone=$phone;
        $user->save();
    }

    /**
     * getImage
     * return the user's image if there's one
     */
    public function getImage() {
        if($this->image!=null)
            return $this->image;
        else
        return 'defaultUser.jpg';
    }
    

    //
    //Age management
    //
    public static function getAge($age) {
        return Carbon::parse($age)->age;
    } 
    public static function getMinAge() {
        $mutable = Carbon::now();
        $mutable->sub(User::MIN_AGE, 'year');
        return $mutable->toDateString();
    }
    public static function getMaxAge() {
        $mutable = Carbon::now();
        $mutable->sub(User::MAX_AGE, 'year');
        return $mutable->toDateString();
    }
}
