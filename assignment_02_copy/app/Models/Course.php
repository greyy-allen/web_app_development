<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    function teacher() {
        return $this->belongsTo('App\Models\User');
    }

    function assessments() {
        return $this->hasMany('App\Models\Assessment');
    }
}
