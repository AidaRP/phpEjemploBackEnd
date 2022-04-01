<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'title' => Str::random(10),
            'description' => Str::random(10),
            'user_id' => 1
        ]);

        DB::table('tasks')->insert([
            'title' => Str::random(10),
            'description' => Str::random(10),
            'user_id' => 1
        ]);

        DB::table('tasks')->insert([
            'title' => Str::random(10),
            'description' => Str::random(10),
            'user_id' => 1
        ]);


        DB::table('tasks')->insert([
            'title' => Str::random(10),
            'description' => Str::random(10),
            'user_id' => 1
        ]);

        DB::table('tasks')->insert([
            'title' => Str::random(10),
            'description' => Str::random(10),
            'user_id' => 2
        ]);

        DB::table('tasks')->insert([
            'title' => Str::random(10),
            'description' => Str::random(10),
            'user_id' => 2
        ]);
    }
}
