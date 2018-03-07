<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectMark extends Model
{
    protected $fillable = [
        'subject_id', 'student_id', 'quiz', 'midterm', 'assignment', 'mini_project'
    ];
}
