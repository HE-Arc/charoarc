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
        //4users with 4 real email

            $c=new User();
            $c->name = "adrienarc";
            $c->email = "adrien.paysant@he-arc.ch";
            $c->password=bcrypt($c->name);
            $tmpCarbonDate= Carbon::now();
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(20,50), 'Year');
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(1,12), 'Month');
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(1,27), 'Day');
            $c->birthday=$tmpCarbonDate->toDateString();
            $c->gender='man';
            $c->interessedBy='woman';
            $c->image = "defaultUser.jpg";
            $c->save();

            $c=new User();
            $c->name = "adrienoutlook";
            $c->email = "adrien.paysant@outlook.com";
            $c->password=bcrypt($c->name);
            $tmpCarbonDate= Carbon::now();
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(20,50), 'Year');
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(1,12), 'Month');
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(1,27), 'Day');
            $c->birthday=$tmpCarbonDate->toDateString();
            $c->gender='woman';
            $c->interessedBy='man';
            $c->image = "defaultUser.jpg";
            $c->save();

            $c=new User();
            $c->name = "lasardine";
            $c->email = "lasardinejohn@gmail.com";
            $c->password=bcrypt($c->name);
            $tmpCarbonDate= Carbon::now();
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(20,30), 'Year');
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(1,12), 'Month');
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(1,27), 'Day');
            $c->birthday=$tmpCarbonDate->toDateString();
            $c->gender='woman';
            $c->interessedBy='oldman';
            $c->image = "defaultUser.jpg";
            $c->save();

            $c=new User();
            $c->name = "papidu";
            $c->email = "papidu50@gmail.com";
            $c->password=bcrypt($c->name);
            $tmpCarbonDate= Carbon::now();
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(50,65), 'Year');
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(1,12), 'Month');
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(1,27), 'Day');
            $c->birthday=$tmpCarbonDate->toDateString();
            $c->gender='oldman';
            $c->interessedBy='woman';
            $c->image = "defaultUser.jpg";
            $c->save();

            $c=new User();
            $c->name = "adrienutbm";
            $c->email = "adrien.paysant@utbm.fr";
            $c->password=bcrypt($c->name);
            $tmpCarbonDate= Carbon::now();
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(20,25), 'Year');
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(1,12), 'Month');
            $tmpCarbonDate = $tmpCarbonDate->sub(rand(1,27), 'Day');
            $c->birthday=$tmpCarbonDate->toDateString();
            $c->gender='woman';
            $c->interessedBy='man';
            $c->image = "defaultUser.jpg";
            $c->save();

      
    }
}