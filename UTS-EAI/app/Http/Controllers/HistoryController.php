<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class HistoryController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())
                          ->with(['schedule.movie'])
                          ->orderBy('created_at', 'desc')
                          ->get();

        return view('history.index', compact('bookings'));
    }
} 