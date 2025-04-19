<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            'code' => '54545',
            'name' => 'Logic',
            'teacher_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('courses')->insert([
            'code' => '12345',
            'name' => 'Calculus',
            'teacher_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('courses')->insert([
            'code' => '85245',
            'name' => 'Statistics',
            'teacher_id' => 2,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('courses')->insert([
            'code' => '546874',
            'name' => 'Physics',
            'teacher_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('courses')->insert([
            'code' => '967521',
            'name' => 'Economics',
            'teacher_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('courses')->insert([
            'code' => '529738',
            'name' => 'History',
            'teacher_id' => 2,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('courses')->insert([
            'code' => '455789',
            'name' => 'Geometry',
            'teacher_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('courses')->insert([
            'code' => '111345',
            'name' => 'Trigonometry',
            'teacher_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('courses')->insert([
            'code' => '587444',
            'name' => 'Magic',
            'teacher_id' => 2,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
