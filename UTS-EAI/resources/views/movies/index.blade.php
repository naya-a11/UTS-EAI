@extends('layouts.app')

@section('title', 'Movies')

@section('content')
<div class="row mb-5">
    <div class="col-12 text-center">
        <h1 class="display-4 mb-3">Now Showing</h1>
        <p class="lead text-muted">Discover and book your favorite movies</p>
    </div>
</div>

<div class="row g-4">
    @foreach($movies as $movie)
    <div class="col-md-4">
        <div class="card h-100">
            <div class="position-relative">
                <img src="{{ $movie->poster_url }}" class="card-img-top movie-poster" alt="{{ $movie->title }}">
                <div class="position-absolute top-0 end-0 m-3">
                    <span class="badge bg-primary">
                        <i class="fas fa-star me-1"></i> {{ $movie->rating }}
                    </span>
                </div>
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title mb-2">{{ $movie->title }}</h5>
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-secondary me-2">{{ $movie->genre }}</span>
                    <span class="text-muted">
                        <i class="fas fa-clock me-1"></i> {{ $movie->duration }} min
                    </span>
                </div>
                <p class="card-text text-muted mb-4">{{ Str::limit($movie->description, 100) }}</p>
                <div class="mt-auto">
                    <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary w-100">
                        <i class="fas fa-ticket-alt me-2"></i> Book Now
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection 