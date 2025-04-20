<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use App\Services\MovieService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;
    protected $movieService;

    public function __construct(BookingService $bookingService, MovieService $movieService)
    {
        $this->bookingService = $bookingService;
        $this->movieService = $movieService;
    }

    public function create($movieId, $scheduleId)
    {
        $movie = $this->movieService->getMovieById($movieId);
        $schedule = $movie->schedules()->findOrFail($scheduleId);
        return view('bookings.create', compact('movie', 'schedule'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'schedule_id' => 'required|exists:schedules,id',
            'seats' => 'required|array',
        ]);

        $booking = $this->bookingService->createBooking(
            auth()->id(),
            $request->movie_id,
            $request->schedule_id,
            $request->seats
        );

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking created successfully!');
    }

    public function show($id)
    {
        $booking = $this->bookingService->getBookingDetails($id);
        return view('bookings.show', compact('booking'));
    }

    public function index()
    {
        $bookings = $this->bookingService->getUserBookings(auth()->id());
        return view('bookings.index', compact('bookings'));
    }
} 