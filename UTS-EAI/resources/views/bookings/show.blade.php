@extends('layouts.app')

@section('title', 'Booking Details - ' . $booking->movie->title)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <img src="{{ $booking->movie->poster_url }}" class="card-img-top movie-poster" alt="{{ $booking->movie->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $booking->movie->title }}</h5>
                <p class="card-text text-muted">
                    <i class="fas fa-clock me-1"></i> {{ $booking->movie->duration }} min
                    <span class="mx-2">|</span>
                    <i class="fas fa-star me-1" style="color: #f1c40f;"></i> {{ $booking->movie->rating }}
                </p>
                <span class="badge bg-primary mb-3">{{ $booking->movie->genre }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-ticket-alt me-2"></i>Booking Details</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Booking ID</h6>
                        <p class="mb-0">{{ $booking->id }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Status</h6>
                        <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : 'warning' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Show Time</h6>
                        <p class="mb-0">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ $booking->schedule->show_time->format('l, M d, Y') }}
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-clock me-1"></i>
                            {{ $booking->schedule->show_time->format('h:i A') }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Seats</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(json_decode($booking->seats) as $seat)
                            <span class="badge bg-primary">{{ $seat }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Number of Tickets</h6>
                        <p class="mb-0">{{ count(json_decode($booking->seats)) }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Total Price</h6>
                        <h5 class="text-primary mb-0">${{ number_format($booking->total_price, 2) }}</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h6 class="text-muted">Booking Date</h6>
                        <p class="mb-0">
                            <i class="fas fa-calendar-check me-1"></i>
                            {{ $booking->created_at->format('l, M d, Y h:i A') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 