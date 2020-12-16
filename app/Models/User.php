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

class User extends Authenticatable  implements MustVerifyEmail
{
    use HasFactory, Notifiable;


    /**
     * const
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

    public static function allUser()
    {
        $users = User::all();
        return $users;
    }   

    public static function getUserById($id)
    {
        $user = User::find($id);
        return $user;
    }  



    /**
     * Tools
     */

    public static function getDislikedUsers(){
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

    /**
     * UPDATER
     */
    public static function updateUserName($id, $name)
    {
        $user = User::find($id);
        $user->name=$name;
        $user->save();
    }
    public static function updateUserEmail($id, $email)
    {
        $user = User::find($id);
        $user->email=$email;
        $user->email_verified_at=null;
        $user->save();
    }
    public static function updateUserGender($id, $gender)
    {
        $user = User::find($id);
        $user->gender=$gender;
        $user->save();
    }
    public static function updateUserInteressedBy($id, $interessedBy)
    {
        $user = User::find($id);
        $user->interessedBy=$interessedBy;
        $user->save();
    }
    public static function updateUserBirthday($id, $birthday)
    {
        $user = User::find($id);
        $user->birthday=$birthday;
        $user->save();
    }
    public static function updateUserDescription($id, $description){
        $user = User::find($id);
        $user->description=($description);
        $user->save();
    }
    public static function updateUserPassword($id, $password)
    {
        $user = User::find($id);
        $user->password=Hash::make($password);
        $user->save();
    }  
    public static function updateUserImage($id, $image)
    {
        $user = User::find($id);
        $user->image=$image;
        $user->save();
    }

    public static function updatePhone($id,$phone){
        $user = User::find($id);
        $user->phone=$phone;
        $user->save();
    }
    /**
     * Image managment
     */
    public static function transformeUserImage($image_file)
    {
        $image = Image::make($image_file);
        //Response::make($image->encode('jpeg'));
        return $image;
    }

    
    public static function fetchUserImage($id)
    {

        $user = User::find($id);

        $image_file = Image::make($user->image);
        $response = Response::make($image_file->encode('jpeg'));
        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

    public function getImage(){
        if($this->image!=null)
            return $this->image;
        else
        return 'defaultUser.jpg';
    }
    
    /**
     * Age managment
     */
    public static function getAge($age)
    {
        return Carbon::parse($age)->age;
    } 

    public static function getMinAge()
    {
        $mutable = Carbon::now();
        $mutable->sub(User::MIN_AGE, 'year');
        return $mutable->toDateString();
    }

    public static function getMaxAge()
    {
        $mutable = Carbon::now();
        $mutable->sub(User::MAX_AGE, 'year');
        return $mutable->toDateString();
    }
}
