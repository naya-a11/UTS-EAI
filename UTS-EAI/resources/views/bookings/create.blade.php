@extends('layouts.app')

@section('title', 'Book Tickets')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title h3 mb-4 text-center">
                    <i class="fas fa-ticket-alt text-primary me-2"></i>Book Your Tickets
                </h1>

                <div class="booking-card mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $schedule->movie->poster_url }}" class="img-fluid rounded" alt="{{ $schedule->movie->title }}">
                        </div>
                        <div class="col-md-8">
                            <h2 class="h4">{{ $schedule->movie->title }}</h2>
                            <p class="text-muted">
                                <i class="fas fa-clock me-2"></i>
                                {{ $schedule->show_time->format('l, M d, Y h:i A') }}
                            </p>
                            <p class="text-muted">
                                <i class="fas fa-theater-masks me-2"></i>
                                Theater {{ $schedule->theater_number }}
                            </p>
                            <p class="text-muted">
                                <i class="fas fa-chair me-2"></i>
                                {{ $schedule->available_seats }} seats available
                            </p>
                            <h4 class="text-primary">
                                <i class="fas fa-tag me-2"></i>
                                Rp {{ number_format($schedule->price, 0, ',', '.') }} per ticket
                            </h4>
                        </div>
                    </div>
                </div>

                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

                    <div class="mb-4">
                        <label for="number_of_tickets" class="form-label">Number of Tickets</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-ticket-alt"></i>
                            </span>
                            <input type="number" 
                                   class="form-control" 
                                   id="number_of_tickets" 
                                   name="number_of_tickets" 
                                   min="1" 
                                   max="{{ $schedule->available_seats }}"
                                   required>
                        </div>
                        <div class="form-text">
                            Maximum {{ $schedule->available_seats }} tickets available
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-check-circle me-2"></i> Confirm Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 