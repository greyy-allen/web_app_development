<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('enrollments')->insert([
            'student_id' => 3,
            'course_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('enrollments')->insert([
            'student_id' => 4,
            'course_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('enrollments')->insert([
            'student_id' => 5,
            'course_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('enrollments')->insert([
            'student_id' => 6,
            'course_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('enrollments')->insert([
            'student_id' => 7,
            'course_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('enrollments')->insert([
            'student_id' => 8,
            'course_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('enrollments')->insert([
            'student_id' => 9,
            'course_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('enrollments')->insert([
            'student_id' => 10,
            'course_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('enrollments')->insert([
            'student_id' => 11,
            'course_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('enrollments')->insert([
            'student_id' => 12,
            'course_id' => 1,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('enrollments')->insert([
            'student_id' => 3,
            'course_id' => 2,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
    }
}
