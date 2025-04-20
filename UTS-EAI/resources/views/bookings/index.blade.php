@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="display-4 text-center mb-4">My Bookings</h1>
        <p class="text-center text-muted">View and manage your movie bookings</p>
    </div>
</div>

@if($bookings->isEmpty())
<div class="text-center">
    <i class="fas fa-ticket-alt fa-4x text-muted mb-3"></i>
    <h3>No Bookings Yet</h3>
    <p class="text-muted">You haven't made any bookings yet. Start by browsing our movies!</p>
    <a href="{{ route('movies.index') }}" class="btn btn-primary">
        <i class="fas fa-film me-1"></i> Browse Movies
    </a>
</div>
@else
<div class="row">
    @foreach($bookings as $booking)
    <div class="col-md-6 mb-4">
        <div class="booking-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h4 class="mb-1">{{ $booking->movie->title }}</h4>
                    <p class="text-muted mb-0">
                        <i class="fas fa-calendar-alt me-1"></i>
                        {{ $booking->schedule->show_time->format('l, M d, Y') }}
                    </p>
                    <p class="text-muted mb-0">
                        <i class="fas fa-clock me-1"></i>
                        {{ $booking->schedule->show_time->format('h:i A') }}
                    </p>
                </div>
                <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : 'warning' }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>

            <div class="mb-3">
                <h6 class="mb-2">Seats</h6>
                <div class="d-flex flex-wrap gap-2">
                    @foreach(json_decode($booking->seats) as $seat)
                    <span class="badge bg-primary">{{ $seat }}</span>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-primary mb-0">${{ number_format($booking->total_price, 2) }}</h5>
                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-outline-primary">
                    <i class="fas fa-eye me-1"></i> View Details
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection 