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
        return view('bookings.create', ['scheduleId' => $scheduleId]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'seats' => 'required|integer|min:1|max:10',
            'payment_method' => 'required|in:credit_card,debit_card,e_wallet'
        ]);

        try {
            return redirect()->route('movies.index')
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