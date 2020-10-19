<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    public static function allPerson()
    {
        $person = Person::all();
        return $person;
    }   

        
}
