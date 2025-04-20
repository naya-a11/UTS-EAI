@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title h3 mb-4 text-center">
                    <i class="fas fa-ticket-alt text-primary me-2"></i>My Bookings
                </h1>

                @if($bookings->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-ticket-alt text-muted" style="font-size: 4rem;"></i>
                        <h3 class="mt-3">No Bookings Yet</h3>
                        <p class="text-muted">You haven't made any bookings yet.</p>
                        <a href="{{ route('movies.index') }}" class="btn btn-primary">
                            <i class="fas fa-film me-2"></i>Browse Movies
                        </a>
                    </div>
                @else
                    @foreach($bookings as $booking)
                        <div class="booking-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ $booking->schedule->movie->poster_url }}" 
                                         class="img-fluid rounded" 
                                         alt="{{ $booking->schedule->movie->title }}">
                                </div>
                                <div class="col-md-6">
                                    <h4>{{ $booking->schedule->movie->title }}</h4>
                                    <div class="mb-2">
                                        <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : 'warning' }}">
                                            <i class="fas fa-{{ $booking->status === 'confirmed' ? 'check-circle' : 'clock' }} me-1"></i>
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>
                                    <p class="text-muted mb-1">
                                        <i class="fas fa-calendar me-2"></i>
                                        {{ $booking->schedule->show_time->format('l, M d, Y') }}
                                    </p>
                                    <p class="text-muted mb-1">
                                        <i class="fas fa-clock me-2"></i>
                                        {{ $booking->schedule->show_time->format('h:i A') }}
                                    </p>
                                    <p class="text-muted mb-1">
                                        <i class="fas fa-theater-masks me-2"></i>
                                        Theater {{ $booking->schedule->theater_number }}
                                    </p>
                                    <p class="text-muted mb-1">
                                        <i class="fas fa-ticket-alt me-2"></i>
                                        {{ $booking->number_of_tickets }} ticket(s)
                                    </p>
                                    <p class="text-primary mb-0">
                                        <i class="fas fa-tag me-2"></i>
                                        Total: Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="col-md-3 d-flex align-items-center justify-content-end">
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-primary">
                                        <i class="fas fa-eye me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 