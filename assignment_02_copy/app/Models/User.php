<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        's_number',
        'user_type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    function taughtCourses() {
        return $this->hasMany('App\Models\Course', 'teacher_id');
    }

    function enrolledCourses(){
        return $this->belongsToMany('App\Models\Course', 'enrollments', 'student_id');
    }

    public function receivedPeerReviews()
    {
        return $this->hasMany('App\Models\PeerReview', 'reviewee_id');
    }

    public function givenPeerReviews()
    {
        return $this->hasMany('App\Models\PeerReview', 'reviewer_id');
    }

    public function studentAssessments()
    {
        return $this->hasMany('App\Models\StudentAssessment', 'student_id');
    }
}
