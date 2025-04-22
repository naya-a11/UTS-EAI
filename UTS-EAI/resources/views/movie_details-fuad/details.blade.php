<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details - Movie Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .movie-details {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 4rem;
        }
        .poster-container {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .poster-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .rating-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: #28a745;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: bold;
            margin-left: 1rem;
            vertical-align: middle;
        }
        .title-rating {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .detail-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .footer-space {
            height: 60px;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Movie Booking</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/" onclick="handleMoviesClick(event)">
                            <i class="fas fa-film"></i> Movies
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('history.index') }}">
                            <i class="fas fa-history"></i> History
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="movie-details">
            <div class="mb-4">
                <a href="/" class="btn btn-outline-dark">
                    <i class="fas fa-arrow-left me-2"></i>Back to Movies
                </a>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="poster-container">
                        <img src="https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_.jpg" alt="Movie Poster" class="img-fluid">
                    </div>
                    <div class="mt-4 text-center">
                        <div class="d-grid">
                            <a href="{{ route('movie.booking') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-ticket-alt me-2"></i>Book Tickets
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="title-rating">
                        <h1 class="display-4 mb-3">Movie Title</h1>
                        <div class="rating-circle">8.5</div>
                    </div>
                    <div class="mb-4">
                        <span class="badge bg-primary me-2">Action</span>
                        <span class="badge bg-secondary me-2">Adventure</span>
                        <span class="badge bg-info me-2">Sci-Fi</span>
                    </div>
                    <div class="detail-section">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <small class="text-muted">Duration</small>
                                <p class="mb-0"><i class="fas fa-clock me-2"></i>2h 30min</p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Release Date</small>
                                <p class="mb-0"><i class="fas fa-calendar me-2"></i>Jan 1, 2024</p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Rating</small>
                                <p class="mb-0"><i class="fas fa-star me-2"></i>PG-13</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Synopsis</h5>
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-section">
                                <h5 class="mb-3">Cast</h5>
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Actor Name 1</h6>
                                            <small>Lead Role</small>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Actor Name 2</h6>
                                            <small>Supporting</small>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Actor Name 3</h6>
                                            <small>Supporting</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-section">
                                <h5 class="mb-3">Crew</h5>
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Director</h6>
                                            <span>John Doe</span>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Writer</h6>
                                            <span>Jane Smith</span>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Producer</h6>
                                            <span>Mike Johnson</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-space"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function handleMoviesClick(event) {
            if (window.location.pathname === '/') {
                event.preventDefault();
                window.location.reload();
            }
        }
    </script>
</body>
</html> 