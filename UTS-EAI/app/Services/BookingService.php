<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BookingService
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function createBooking($userId, $movieId, $scheduleId, $seats)
    {
        return DB::transaction(function () use ($userId, $movieId, $scheduleId, $seats) {
            $booking = Booking::create([
                'user_id' => $userId,
                'movie_id' => $movieId,
                'schedule_id' => $scheduleId,
                'seats' => $seats,
                'status' => 'confirmed'
            ]);

            $this->movieService->updateMovieStatistics($movieId);

            return $booking;
        });
    }

    public function getUserBookings($userId)
    {
        return Booking::with(['movie', 'schedule'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getBookingDetails($bookingId)
    {
        return Booking::with(['movie', 'schedule', 'user'])
            ->findOrFail($bookingId);
    }
} 