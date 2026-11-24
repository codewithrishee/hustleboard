<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutreachLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'contacted_at' => 'datetime',
        'follow_up_date' => 'date',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}