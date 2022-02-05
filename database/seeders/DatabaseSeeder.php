<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'Nori',
            'email' => 'sample.sample@sample.com',
            'password' => Hash::make('password'),
            'max_objectives_num' => 100,
            'max_tasks_num' => 100,

        ]);

        $this->call(ObjectivesTableSeeder::class);
    }
}
