<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'movie_id',
        'name',
        'email',
        'phone',
        'seats',
        'payment_method',
        'status'
    ];

    protected $casts = [
        'number_of_tickets' => 'integer',
        'total_price' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
} 