@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h1 class="card-title h3">
                        <i class="fas fa-ticket-alt text-primary me-2"></i>Booking Details
                    </h1>
                    <div class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : 'warning' }} mb-3">
                        <i class="fas fa-{{ $booking->status === 'confirmed' ? 'check-circle' : 'clock' }} me-1"></i>
                        {{ ucfirst($booking->status) }}
                    </div>
                </div>

                <div class="booking-card">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $booking->schedule->movie->poster_url }}" class="img-fluid rounded" alt="{{ $booking->schedule->movie->title }}">
                        </div>
                        <div class="col-md-8">
                            <h2 class="h4 mb-3">{{ $booking->schedule->movie->title }}</h2>
                            
                            <div class="mb-3">
                                <h5 class="text-muted mb-2">Show Details</h5>
                                <p class="mb-2">
                                    <i class="fas fa-calendar me-2"></i>
                                    {{ $booking->schedule->show_time->format('l, M d, Y') }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-clock me-2"></i>
                                    {{ $booking->schedule->show_time->format('h:i A') }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-theater-masks me-2"></i>
                                    Theater {{ $booking->schedule->theater_number }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <h5 class="text-muted mb-2">Booking Details</h5>
                                <p class="mb-2">
                                    <i class="fas fa-ticket-alt me-2"></i>
                                    {{ $booking->number_of_tickets }} ticket(s)
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-tag me-2"></i>
                                    Total Price: Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-clock me-2"></i>
                                    Booked on {{ $booking->created_at->format('M d, Y h:i A') }}
                                </p>
                            </div>

                            <div class="mb-3">
                                <h5 class="text-muted mb-2">Customer Details</h5>
                                <p class="mb-2">
                                    <i class="fas fa-user me-2"></i>
                                    {{ $booking->user->name }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-envelope me-2"></i>
                                    {{ $booking->user->email }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('bookings.index') }}" class="btn btn-primary">
                        <i class="fas fa-list me-2"></i>View All Bookings
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 