<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeerReview extends Model
{
    use HasFactory;

    function assessmentPeerReview() {
        return $this->belongsTo('App\Models\Assessment');
    }

    public function reviewer() {
        return $this->belongsTo('App\Models\User', 'reviewer_id');
    }

    public function reviewee() {
        return $this->belongsTo('App\Models\User', 'reviewee_id');
    }
}
