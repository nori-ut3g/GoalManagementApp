<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('objectives')->insert([
            'title' => 'Task Management Appを完成させる',
            'user_id' => 1,
            'start_date' => '2022-01-05',
            'due_date' => '2022-01-22',
            'status' => 0,
            'finish_date' => '2022-02-09',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
