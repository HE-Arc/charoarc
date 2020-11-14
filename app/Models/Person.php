<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Person extends Model
{
    //have to do, because laravl wan't plural word
    protected $table = "person";

    //ici on fera les fonctions qui font les requetes pour lister une personne ou modifier etc.
    public function getGender()
    {
        return $this->gender;
    }   





    //static function

    //une fois avec eloquent
    public static function allPerson0()
    {
        $person = Person::all();
        return $person;
    }  
    //une fois avec facadeDB
    public static function allPerson()
    {
        $person = DB::table('person')->get();
        return $person;
    }
    public static function getPersonByName($name)
    {
        $per = DB::table('person')->where('nickname', $name)->first();
        return $per;
    } 

        
}
