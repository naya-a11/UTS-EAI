<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BookingService
{
    protected $movieService;
    protected $userService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function createBooking($userId, $scheduleId, $numberOfTickets)
    {
        return DB::transaction(function () use ($userId, $scheduleId, $numberOfTickets) {
            $schedule = Schedule::findOrFail($scheduleId);
            
            if ($schedule->available_seats < $numberOfTickets) {
                throw new \Exception('Not enough seats available');
            }

            $booking = Booking::create([
                'user_id' => $userId,
                'schedule_id' => $scheduleId,
                'number_of_tickets' => $numberOfTickets,
                'total_price' => $schedule->price * $numberOfTickets,
                'status' => 'confirmed'
            ]);

            $schedule->decrement('available_seats', $numberOfTickets);
            
            // Update movie statistics
            $this->movieService->updateMovieStats($schedule->movie_id, $numberOfTickets);

            return $booking;
        });
    }

    public function getUserBookings($userId)
    {
        return Booking::with(['schedule.movie', 'user'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getBookingDetails($bookingId)
    {
        return Booking::with(['schedule.movie', 'user'])
            ->findOrFail($bookingId);
    }
} 