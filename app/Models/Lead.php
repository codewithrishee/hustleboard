<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $guarded = [];

    public function outreachLogs()
    {
        return $this->hasMany(OutreachLog::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}