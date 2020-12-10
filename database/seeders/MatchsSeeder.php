<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Match;


class MatchsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m=new Match();
        $m->user_id1=1;
        $m->user_id2=2;
        $m->status_user1=true;
        $m->is_done=false;
        $m->save();

        $m=new Match();
        $m->user_id1=1;
        $m->user_id2=3;
        $m->status_user1=true;
        $m->status_user2=false;
        $m->is_done=true;
        $m->save();

        $m=new Match();
        $m->user_id1=2;
        $m->user_id2=4;
        $m->status_user2=true;
        $m->is_done=false;
        $m->save();
    }
}
