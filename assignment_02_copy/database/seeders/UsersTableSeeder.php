<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "test_teacher1",
            'email' => 'test_teacher1@gmail.com',
            's_number' => 's7654321',
            'user_type' => 'teacher',
            'password' => bcrypt('password'),
        ]);
    
        DB::table('users')->insert([
            'name' => "test_teacher2",
            'email' => 'test_teacher2@gmail.com',
            's_number' => 's7654322',
            'user_type' => 'teacher',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => "test_student01",
            'email' => 'test_student01@gmail.com',
            's_number' => 's1234567',
            'user_type' => 'student',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => "test_student02",
            'email' => 'test_student02@gmail.com',
            's_number' => 's9638521',
            'user_type' => 'student',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => "test_student03",
            'email' => 'test_student03@gmail.com',
            's_number' => 's5648971',
            'user_type' => 'student',
            'password' => bcrypt('password'),
        ]);
        
        DB::table('users')->insert([
            'name' => "test_student04",
            'email' => 'test_student04@gmail.com',
            's_number' => 's1234504',
            'user_type' => 'student',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => "test_student10",
            'email' => 'test_student10@gmail.com',
            's_number' => 's9638510',
            'user_type' => 'student',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => "test_student11",
            'email' => 'test_student11@gmail.com',
            's_number' => 's5648911',
            'user_type' => 'student',
            'password' => bcrypt('password'),
        ]);
        
        DB::table('users')->insert([
            'name' => "test_student12",
            'email' => 'test_student12@gmail.com',
            's_number' => 's1234512',
            'user_type' => 'student',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => "test_student05",
            'email' => 'test_student05@gmail.com',
            's_number' => 's9638505',
            'user_type' => 'student',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => "test_student06",
            'email' => 'test_student06@gmail.com',
            's_number' => 's5648906',
            'user_type' => 'student',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => "test_student07",
            'email' => 'test_student07@gmail.com',
            's_number' => 's1234507',
            'user_type' => 'student',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => "test_student08",
            'email' => 'test_student08@gmail.com',
            's_number' => 's9638508',
            'user_type' => 'student',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => "test_student09",
            'email' => 'test_student09@gmail.com',
            's_number' => 's5648909',
            'user_type' => 'student',
            'password' => bcrypt('password'),
        ]);

    }
}
