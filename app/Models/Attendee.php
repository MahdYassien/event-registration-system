<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $fillable = [
    'name', 
    'email', 
    'phone', 
    'company'
];

public function registrations()
{
    return $this->hasMany(Registration::class);
}

public function events()
{
    return $this->belongsToMany(Event::class, 'registrations');
}
}
