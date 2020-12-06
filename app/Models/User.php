<?php

namespace App\Models;

use Carbon\Carbon;
use Image;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
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
