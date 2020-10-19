<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Person;
use Carbon\Carbon;

class InitPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 30; $i++) 
        {           
            $year = rand(1986, 2002);
            $month = rand(1, 12);
            $day = rand(1, 28);
            $date = Carbon::create($year,$month ,$day , 0, 0, 0);

            $rand = Str::random(10,99);
            $c = new Person();
            $c->nickname = "toto_".$rand;
            $c->email = "mail_".$rand."@gmail.com";
            $c->password="password_".$rand;
            $c->age=$date;
            $c->gender="lgbtiq++".$rand;
            $c->interessed_by="gold shower";
            $c->picture_path="/image\/_".$rand;
            $c->save();
        }       
    }
}
