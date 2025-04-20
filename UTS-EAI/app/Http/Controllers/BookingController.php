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

    public function create($scheduleId)
    {
        $schedule = $this->movieService->getMovieSchedules($scheduleId)->first();
        return view('bookings.create', compact('schedule'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'number_of_tickets' => 'required|integer|min:1'
        ]);

        try {
            $booking = $this->bookingService->createBooking(
                auth()->id(),
                $request->schedule_id,
                $request->number_of_tickets
            );

            return redirect()->route('bookings.show', $booking->id)
                ->with('success', 'Booking created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
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