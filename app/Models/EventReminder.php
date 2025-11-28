<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'academic_event_id',
        'reminder_time',
        'is_sent'
    ];

    protected $casts = [
        'reminder_time' => 'datetime',
        'is_sent' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function academicEvent()
    {
        return $this->belongsTo(AcademicEvent::class);
    }
}
