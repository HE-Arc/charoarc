<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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

