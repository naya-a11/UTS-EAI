@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="movie-poster">
                <img src="{{ $movie->poster_url }}" class="card-img-top" alt="{{ $movie->title }}">
            </div>
            <div class="card-body">
                <h1 class="card-title h3">{{ $movie->title }}</h1>
                <div class="mb-3">
                    <span class="badge bg-primary me-2">{{ $movie->genre }}</span>
                    <span class="badge bg-warning text-dark">
                        <i class="fas fa-star me-1"></i> {{ $movie->rating }}
                    </span>
                </div>
                <p class="card-text">
                    <i class="fas fa-clock me-2"></i> Duration: {{ $movie->duration }} minutes
                </p>
                <p class="card-text">
                    <i class="fas fa-calendar me-2"></i> Release Date: {{ $movie->release_date->format('M d, Y') }}
                </p>
                <p class="card-text">
                    <i class="fas fa-ticket-alt me-2"></i> Tickets Sold: {{ $movie->tickets_sold }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title h4 mb-4">About the Movie</h2>
                <p class="card-text">{{ $movie->description }}</p>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h2 class="card-title h4 mb-4">Showtimes</h2>
                @foreach($schedules as $schedule)
                <div class="schedule-card">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h5 class="mb-0">
                                <i class="fas fa-clock me-2"></i>
                                {{ $schedule->show_time->format('l, M d, Y h:i A') }}
                            </h5>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-0">
                                <i class="fas fa-theater-masks me-2"></i>
                                Theater {{ $schedule->theater_number }}
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-0">
                                <i class="fas fa-chair me-2"></i>
                                {{ $schedule->available_seats }} seats left
                            </p>
                        </div>
                        <div class="col-md-2 text-end">
                            <a href="{{ route('bookings.create', $schedule->id) }}" class="btn btn-primary">
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