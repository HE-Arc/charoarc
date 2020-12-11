<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayGender = ["woman", "man"];
        for ($i = 1; $i <= 10; $i++) 
        {
            $c=new User();
            $c->name = "user{$i}";
            $c->email = $c->name."@mail.ch";
            $c->password=bcrypt($c->name);
            $tmpCarbonDate= Carbon::now();
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(20,50), 'Year');
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(20,50), 'Month');
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(20,50), 'Day');
            $c->birthday=$tmpCarbonDate->toDateString();
            $c->gender=$arrayGender[rand(0,1)];
            $c->interessedBy=$arrayGender[rand(0,1)];
            $c->image = "defaultUser.jpg";
            $c->save();
        }
    }
}