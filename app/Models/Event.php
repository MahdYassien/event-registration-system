<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
    'title', 'description', 'date_time', 'location', 'capacity', 'price', 'status'
];

public function registrations() {
    return $this->hasMany(Registration::class);
}

// Advanced: You can also link directly to Attendees through Registrations
public function attendees() {
    return $this->hasManyThrough(Attendee::class, Registration::class);
}
}
