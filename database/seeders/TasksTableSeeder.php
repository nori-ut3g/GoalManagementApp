<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(0,10) as $num){
            DB::table('tasks')->insert([
                'objective_id' => $num % 3 + 1,
                'order'=>$num,
                'status' => $num % 3,
                'title' => 'sample '. $num,
                'content' =>"content",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
        }
    }
}
