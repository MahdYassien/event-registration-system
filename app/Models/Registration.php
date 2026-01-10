<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
    'event_id', 
    'attendee_id', 
    'registration_date', 
    'status', 
    'payment_status'
];

public function event()
{
    return $this->belongsTo(Event::class);
}

public function attendee()
{
    return $this->belongsTo(Attendee::class);
}

protected static function booted()
{
    static::updated(function ($registration) {
        if ($registration->status === 'cancelled') {
            $next = Registration::where('event_id', $registration->event_id)
                ->where('status', 'waitlisted')
                ->orderBy('created_at')
                ->first();

            if ($next) {
                $next->update(['status' => 'confirmed']);
            }
        }
    });
}

}
