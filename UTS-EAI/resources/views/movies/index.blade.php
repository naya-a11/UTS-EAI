@extends('layouts.app')

@section('title', 'Movies')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="display-4 text-center mb-4">
            <i class="fas fa-film text-primary me-2"></i>Now Showing
        </h1>
    </div>
</div>

<div class="row">
    @foreach($movies as $movie)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="movie-poster">
                <img src="{{ $movie->poster_url }}" class="card-img-top" alt="{{ $movie->title }}">
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $movie->title }}</h5>
                <p class="card-text text-muted">
                    <i class="fas fa-clock me-1"></i> {{ $movie->duration }} min
                    <span class="mx-2">|</span>
                    <i class="fas fa-star text-warning me-1"></i> {{ $movie->rating }}
                </p>
                <p class="card-text">{{ Str::limit($movie->description, 100) }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge bg-primary">{{ $movie->genre }}</span>
                    <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary">
                        <i class="fas fa-ticket-alt me-1"></i> Book Now
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection 