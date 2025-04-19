<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AssessmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assessments')->insert([
            'title' => 'Assessment 1A',
            'instruction' => 'This is an instruction for Assessment 1A',
            'required_reviews' => 2,
            'assessment_type' => 'student_select',
            'course_id' => 1,
            'max_score' => 50,
            'due_date' => '2024-10-10 15:30:00'
        ]);

        DB::table('assessments')->insert([
            'title' => 'Assessment 2A',
            'instruction' => 'This is an instruction for Assessment 2A',
            'required_reviews' => 2,
            'assessment_type' => 'student_select',
            'course_id' => 1,
            'max_score' => 25,
            'due_date' => '2024-10-10 15:30:00'
        ]);

        DB::table('assessments')->insert([
            'title' => 'Assessment 1B',
            'instruction' => 'This is an instruction for Assessment 1B',
            'required_reviews' => 2,
            'assessment_type' => 'student_select',
            'course_id' => 2,
            'max_score' => 40,
            'due_date' => '2024-10-10 15:30:00'
        ]);
    }
}
