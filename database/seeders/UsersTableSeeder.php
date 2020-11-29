<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayGender = ["woman", "man"];
        for ($i = 0; $i <= 10; $i++) 
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
            $c->save();
        }
    }

        private function oldversion()
        {
            $c=new User();
            $c->name = "Charlie";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=25;
            $c->gender="man";
            $c->interessedBy="woman";        
            $c->save();

            $c=new User();
            $c->name = "Bond";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=25;
            $c->gender="man";
            $c->interessedBy="woman";        
            $c->save();

            $c=new User();
            $c->name = "Bertrand";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=25;
            $c->gender="woman";
            $c->interessedBy="woman";        
            $c->save();

            $c=new User();
            $c->name = "Flavien";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=25;
            $c->gender="man";
            $c->interessedBy="man";        
            $c->save();

            $c=new User();
            $c->name = "Baptiste";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=25;
            $c->gender="man";
            $c->interessedBy="man";        
            $c->save();

            $c=new User();
            $c->name = "Lolita";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=47;
            $c->gender="woman";
            $c->interessedBy="woman";        
            $c->save();

            $c=new User();
            $c->name = "Lucas";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=20;
            $c->gender="man";
            $c->interessedBy="woman";        
            $c->save();

            $c=new User();
            $c->name = "Adrien";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=20;
            $c->gender="man";
            $c->interessedBy="woman";        
            $c->save();

            $c=new User();
            $c->name = "Sarah";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=25;
            $c->gender="woman";
            $c->interessedBy="man";        
            $c->save();

            $c=new User();
            $c->name = "Matthieu";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=23;
            $c->gender="man";
            $c->interessedBy="woman";        
            $c->save();

            $c=new User();
            $c->name = "Lisa";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=20;
            $c->gender="woman";
            $c->interessedBy="man";        
            $c->save();

            $c=new User();
            $c->name = "Joris";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=20;
            $c->gender="man";
            $c->interessedBy="woman";        
            $c->save();

            $c=new User();
            $c->name = "Edward";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=28;
            $c->gender="man";
            $c->interessedBy="man";        
            $c->save();

            $c=new User();
            $c->name = "Dianna";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=25;
            $c->gender="woman";
            $c->interessedBy="man";        
            $c->save();

            $c=new User();
            $c->name = "Chucky";
            $c->email = $c->name."@gmail.com";
            $c->password=bcrypt($c->name);
            $c->age=55;
            $c->gender="man";
            $c->interessedBy="woman";        
            $c->save();
        }    
    }

