<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    public function user()
    {
    return $this->belongsTo(User::class);
    }

public function attendance()
    {
    return $this->belongsTo(Attendance::class);
    }

public function approver()
    {
    return $this->belongsTo(User::class, 'approved_by');
    }
}
