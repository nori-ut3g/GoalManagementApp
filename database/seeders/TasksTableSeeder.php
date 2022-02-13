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

//        $taskSamples = [
//            [
//                'user_id' => 1,
//                'objective_id' => 1,
//                'status' => 2,
//                'title' => '環境構築する',
//                'note' => '',
//                'start_date' => '2020-01-31',
//                'finish_date' => '2020-02-01',
//            ],
//        ];
//
//
//        foreach($taskSamples as $title){
//            DB::table('tasks')->insert([
//                'user_id' => $title['user_id'],
//                'objective_id' => $title['objective_id'],
//                'status' => $title['status'],
//                'title' => $title['title'],
//                'note' => $title['note'],
//                'start_date' => $title['start_date'],
//                'finish_date' => $title['finish_date'],
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now(),
//
//            ]);
//        }
    }
}
