<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'genre',
        'rating',
        'poster_url',
        'tickets_sold',
        'release_date'
    ];

    protected $casts = [
        'release_date' => 'date',
        'tickets_sold' => 'integer'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function bookings()
    {
        return $this->hasManyThrough(Booking::class, Schedule::class);
    }
} 