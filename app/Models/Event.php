<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
    'title', 'description', 'date_time', 'location', 'capacity', 'price', 'status'
];

protected $casts = [
    'date_time' => 'datetime',
];

public function registrations() {
    return $this->hasMany(Registration::class);
}

public function attendees()
{
    return $this->belongsToMany(Attendee::class, 'registrations');
}
}
