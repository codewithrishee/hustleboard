<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job_applications';

    protected $guarded = [];

    protected $casts = [
        'applied_date' => 'date',
        'follow_up_date' => 'date',
        'interview_date' => 'date',
    ];
}