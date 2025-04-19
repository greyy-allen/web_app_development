<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
    
    function courseAssessment() {
        return $this->belongsTo('App\Models\Course');
    }

    function peerReviews() {
        return $this->hasMany('App\Models\PeerReview');
    }
}
