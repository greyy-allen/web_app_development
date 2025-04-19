<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAssessment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'assessment_id', 'final_score'];

    public function student() {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    function assessment() {
        return $this->belongsTo('App\Models\Assessment');
    }
}
