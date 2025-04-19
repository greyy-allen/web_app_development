<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeerReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('peer_reviews')->insert([
            'assessment_id' => 1,
            'reviewer_id' => 4,
            'reviewee_id' => 3,
            'review' => 'He did a great job!',
            'score' => '40'
        ]);

        DB::table('peer_reviews')->insert([
            'assessment_id' => 1,
            'reviewer_id' => 3,
            'reviewee_id' => 4,
            'review' => 'That was an awesome demonstration',
            'score' => '45'
        ]);

        DB::table('peer_reviews')->insert([
            'assessment_id' => 1,
            'reviewer_id' => 3,
            'reviewee_id' => 5,
            'review' => 'The demo was quick and easy!',
            'score' => '45'
        ]);
    }
}

