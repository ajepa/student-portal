<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAssessment extends Model
{
    protected $fillable = [
        'student_id', 'assessment_id', 'marks'
    ];
}
