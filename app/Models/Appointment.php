<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['user_id', 'counselor_id', 'date', 'time', 'status'];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
        'status' => 'string',
    ];

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming');
    }

    public function scopePast($query)
    {
        return $query->where('status', 'past');
    }

    public function counselor()
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function statusHistory()
    {
        return $this->hasMany(StatusHistory::class);
    }

    public function getAppointmentDateTimeAttribute()
    {
        return Carbon::parse($this->getRawOriginal('date') . ' ' . $this->getRawOriginal('time'));
    }

}