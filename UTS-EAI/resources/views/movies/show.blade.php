@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="position-relative">
                <img src="{{ $movie->poster_url }}" class="card-img-top movie-poster" alt="{{ $movie->title }}">
                <div class="position-absolute top-0 end-0 m-3">
                    <span class="badge bg-primary">
                        <i class="fas fa-star me-1"></i> {{ $movie->rating }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title mb-3">{{ $movie->title }}</h5>
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-secondary me-2">{{ $movie->genre }}</span>
                    <span class="text-muted">
                        <i class="fas fa-clock me-1"></i> {{ $movie->duration }} min
                    </span>
                </div>
                <p class="card-text text-muted mb-4">{{ $movie->description }}</p>
                <div class="d-flex align-items-center text-muted mb-3">
                    <i class="fas fa-ticket-alt me-2"></i>
                    <span>{{ $movie->total_bookings }} bookings</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-transparent border-0">
                <h4 class="mb-0">
                    <i class="fas fa-calendar-alt me-2 text-primary"></i>
                    Available Showtimes
                </h4>
            </div>
            <div class="card-body">
                @foreach($schedules as $schedule)
                <div class="schedule-card">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="d-flex flex-column">
                                <h6 class="mb-1">
                                    <i class="fas fa-clock me-2 text-primary"></i>
                                    {{ $schedule->show_time->format('l, M d, Y') }}
                                </h6>
                                <small class="text-muted">{{ $schedule->show_time->format('h:i A') }}</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-chair me-2 text-primary"></i>
                                <span>{{ $schedule->available_seats }} seats available</span>
                            </div>
                        </div>
                        <div class="col-md-3 text-end">
                            <h5 class="text-primary mb-0">${{ number_format($schedule->price, 2) }}</h5>
                        </div>
                        <div class="col-md-2 text-end">
                            <a href="{{ route('bookings.create', ['movie' => $movie->id, 'schedule' => $schedule->id]) }}" 
                               class="btn btn-primary">
                                <i class="fas fa-ticket-alt me-1"></i> Book
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 