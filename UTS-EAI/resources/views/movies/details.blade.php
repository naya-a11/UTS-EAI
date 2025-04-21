@extends('layouts.app')

@section('title', 'Movie Details')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Movie Poster -->
        <div class="col-md-4 mb-4">
            <div class="movie-poster">
                <img src="https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg" class="img-fluid rounded-3 shadow" alt="The Dark Knight Movie Poster">
            </div>
        </div>
        
        <!-- Movie Details -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title mb-4">The Dark Knight</h1>
                    
                    <div class="movie-meta mb-4">
                        <span class="badge bg-primary me-2">Action</span>
                        <span class="badge bg-secondary me-2">Crime</span>
                        <span class="badge bg-info me-2">Drama</span>
                        <span class="badge bg-warning">2h 32m</span>
                    </div>
                    
                    <div class="movie-rating mb-4">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star-half-alt text-warning"></i>
                        <span class="ms-2">9.0/10</span>
                    </div>
                    
                    <h5 class="text-muted mb-3">Synopsis</h5>
                    <p class="card-text mb-4">
                        Batman raises the stakes in his war on crime. With the help of Lt. Jim Gordon and District Attorney Harvey Dent, 
                        Batman sets out to dismantle the remaining criminal organizations that plague the streets. The partnership proves 
                        to be effective, but they soon find themselves prey to a reign of chaos unleashed by a rising criminal mastermind 
                        known to the terrified citizens of Gotham as the Joker.
                    </p>
                    
                    <div class="movie-info mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Director:</strong> Christopher Nolan</p>
                                <p><strong>Release Date:</strong> July 18, 2008</p>
                                <p><strong>Language:</strong> English</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Cast:</strong></p>
                                <ul class="list-unstyled">
                                    <li>• Christian Bale as Batman</li>
                                    <li>• Heath Ledger as Joker</li>
                                    <li>• Aaron Eckhart as Harvey Dent</li>
                                    <li>• Michael Caine as Alfred</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Showtimes Section -->
                    <div class="showtimes mt-4">
                        <h5 class="text-muted mb-3">Available Showtimes</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card schedule-card">
                                    <div class="text-center">
                                        <h6 class="mb-2">Today</h6>
                                        <p class="mb-2">13:00</p>
                                        <a href="{{ route('bookings.create', ['scheduleId' => 1]) }}" class="btn btn-primary btn-sm">Book Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card schedule-card">
                                    <div class="text-center">
                                        <h6 class="mb-2">Today</h6>
                                        <p class="mb-2">16:30</p>
                                        <a href="{{ route('bookings.create', ['scheduleId' => 2]) }}" class="btn btn-primary btn-sm">Book Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card schedule-card">
                                    <div class="text-center">
                                        <h6 class="mb-2">Today</h6>
                                        <p class="mb-2">20:00</p>
                                        <a href="{{ route('bookings.create', ['scheduleId' => 3]) }}" class="btn btn-primary btn-sm">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 