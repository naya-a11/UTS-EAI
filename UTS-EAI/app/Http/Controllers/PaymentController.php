<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        // Get data from session storage
        $selectedSeats = json_decode(session('selectedSeats', '[]'), true);
        $totalPrice = session('totalPrice', 0);
        
        // Calculate service fee (5% of total price)
        $serviceFee = $totalPrice * 0.05;
        $grandTotal = $totalPrice + $serviceFee;

        return view('pembayan-ami.payment', [
            'selectedSeats' => $selectedSeats,
            'totalPrice' => $totalPrice,
            'serviceFee' => $serviceFee,
            'grandTotal' => $grandTotal
        ]);
    }

    public function success()
    {
        return view('pembayan-ami.success', [
            'message' => 'Payment Successful!',
            'orderNumber' => 'ORD-' . strtoupper(uniqid())
        ]);
    }
} 