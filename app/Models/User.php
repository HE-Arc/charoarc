<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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

    public static function updateUserName($id, $name)
    {
        $user = User::find($id);
        $user->name=$name;
        $user->save();
        return $user;
    }  


//pour tester
    public function getName()
    {
        return $this->name;
    } 
}
