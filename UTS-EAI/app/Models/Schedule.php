<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'show_time',
        'price',
        'available_seats',
        'theater_number'
    ];

    protected $casts = [
        'show_time' => 'datetime',
        'price' => 'decimal:2',
        'available_seats' => 'integer'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
} 