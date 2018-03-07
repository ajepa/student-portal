<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LecturerSubject extends Model
{
    protected $fillable = [
        'lecturer_id', 'subject_id'
    ];
}
