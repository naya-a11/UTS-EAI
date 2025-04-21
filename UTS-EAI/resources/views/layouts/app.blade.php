<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Movie Booking System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1B2838;
            --secondary-color: #2E9AFE;
            --accent-color: #fd79a8;
            --background-color: #171E27;
            --text-color: #ffffff;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: var(--primary-color);
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .navbar-brand {
            padding: 0;
            margin: 0;
        }

        .navbar-brand img {
            height: 60px;
            width: auto;
            object-fit: contain;
            margin-right: 20px;
        }

        .brand-logo {
            height: 50px;
            width: auto;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .brand-studio {
            font-size: 0.9rem;
            color: white;
            letter-spacing: 2px;
        }

        .brand-name {
            font-size: 1.4rem;
            color: white;
            font-weight: bold;
        }

        .brand-cinematography {
            font-size: 0.8rem;
            color: #2E9AFE;
            letter-spacing: 1px;
        }

        .nav-link {
            color: var(--text-color) !important;
            font-size: 0.9rem;
            padding: 0.5rem 1rem !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        .navbar-nav {
            gap: 0.5rem;
        }

        .search-form {
            flex-grow: 1;
            max-width: 600px;
            margin: 0 2rem;
        }

        .search-input {
            width: 100%;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            border: none;
            background-color: rgba(255,255,255,0.1);
            color: white;
        }

        .search-input::placeholder {
            color: rgba(255,255,255,0.5);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .hero-section {
            position: relative;
            min-height: 500px;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .book-tickets-btn {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .book-tickets-btn:hover {
            background-color: #ff8534;
            transform: translateY(-2px);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .movie-poster {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .schedule-card {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
        }

        .booking-card {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .alert {
            border-radius: 15px;
            border: none;
        }

        .alert-success {
            background-color: #00b894;
            color: white;
        }

        .alert-danger {
            background-color: #d63031;
            color: white;
        }

        /* Carousel Styles */
        .movie-carousel {
            margin-top: 0;
            position: relative;
            background: var(--background-color);
        }

        .carousel-item {
            height: 600px;
            background-position: center;
            background-size: cover;
            position: relative;
        }

        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(23, 30, 39, 0) 0%, rgba(23, 30, 39, 1) 100%);
            pointer-events: none;
        }

        .carousel-caption {
            bottom: 100px;
            text-align: left;
            max-width: 600px;
            left: 10%;
        }

        .carousel-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .carousel-description {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        .carousel-btn {
            background-color: var(--secondary-color);
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .carousel-btn:hover {
            background-color: #3aa8ff;
            color: white;
            transform: translateY(-2px);
        }

        .carousel-indicators {
            bottom: 30px;
        }

        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 6px;
        }

        .carousel-control-prev, .carousel-control-next {
            width: 5%;
            opacity: 0.7;
        }

        .carousel-control-prev:hover, .carousel-control-next:hover {
            opacity: 1;
        }

        .movies-section {
            padding: 40px 0;
            background-color: var(--background-color);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .view-all {
            padding: 8px 20px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            text-decoration: none;
            border-radius: 20px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .view-all:hover {
            background-color: var(--secondary-color);
            color: #fff;
        }

        .movie-filters {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            padding-bottom: 10px;
        }

        .filter-btn {
            padding: 8px 20px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: none;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .filter-btn.active {
            background-color: var(--secondary-color);
        }

        .filter-btn:hover {
            background-color: var(--secondary-color);
        }

        .movies-container {
            position: relative;
            margin: 0 -10px;
            padding: 0 10px;
        }

        .movies-scroll {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding: 10px 0;
            scroll-behavior: smooth;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .movies-scroll::-webkit-scrollbar {
            display: none;
        }

        .movie-card {
            flex: 0 0 200px;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease;
            background-color: #1a2634;
        }

        .movie-card:hover {
            transform: translateY(-5px);
        }

        .movie-poster {
            position: relative;
            aspect-ratio: 2/3;
            overflow: hidden;
        }

        .movie-poster img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .pre-sale-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ffd700;
            color: #000;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }

        .movie-info {
            padding: 15px;
        }

        .movie-title {
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .buy-ticket-btn {
            display: block;
            width: 100%;
            padding: 8px;
            background-color: var(--secondary-color);
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .buy-ticket-btn:hover {
            background-color: #3aa8ff;
            color: #fff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('movies.index') }}">
                <img src="{{ asset('images/moononton-logo.png') }}" alt="Studio Moononton Cinematography" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="search-form d-flex">
                    <input type="search" class="search-input" placeholder="Search movies..." aria-label="Search">
                </form>
                <ul class="navbar-nav ms-auto user-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('movies.index') }}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bookings.index') }}">TICKETS</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Movie Carousel -->
    <div id="movieCarousel" class="carousel slide movie-carousel" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#movieCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#movieCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#movieCarousel" data-bs-slide-to="2"></button>
        </div>
        
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('https://images.unsplash.com/photo-1685164771456-9e29b3309a53?q=80&w=1932&auto=format&fit=crop');">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h1 class="carousel-title">Sinners (2025)</h1>
                    <p class="carousel-description">Experience the thrill of this action-packed adventure that will keep you on the edge of your seat.</p>
                    <a href="#" class="carousel-btn">GET TICKETS</a>
                </div>
            </div>
            
            <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1685164771456-9e29b3309a53?q=80&w=1932&auto=format&fit=crop');">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h1 class="carousel-title">The Amateur (2025)</h1>
                    <p class="carousel-description">A gripping tale of suspense and mystery that will leave you guessing until the very end.</p>
                    <a href="#" class="carousel-btn">GET TICKETS</a>
                </div>
            </div>
            
            <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1685164771456-9e29b3309a53?q=80&w=1932&auto=format&fit=crop');">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h1 class="carousel-title">The Chosen: Las Supper Part 3</h1>
                    <p class="carousel-description">The epic conclusion to the trilogy that has captivated audiences worldwide.</p>
                    <a href="#" class="carousel-btn">GET TICKETS</a>
                </div>
            </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#movieCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#movieCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Now Showing Section -->
    <section class="movies-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-film"></i>
                    Sedang Tayang
                </h2>
                <a href="#" class="view-all">Semua <i class="fas fa-chevron-right"></i></a>
            </div>

            <div class="movie-filters">
                <button class="filter-btn active">Semua Film</button>
                <button class="filter-btn">
                    <i class="fas fa-heart"></i> Watchlist Saya
                </button>
            </div>

            <div class="movies-container">
                <div class="movies-scroll">
                    <!-- Movie Card 1 -->
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/until-dawn.jpg') }}" alt="Until Dawn">
                            <div class="pre-sale-badge">PRE-SALE</div>
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Until Dawn</h3>
                            <a href="#" class="buy-ticket-btn">BELI TIKET</a>
                        </div>
                    </div>

                    <!-- Movie Card 2 -->
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/jon-bernthal.jpg') }}" alt="Jon Bernthal">
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Jon Bernthal</h3>
                            <a href="#" class="buy-ticket-btn">BELI TIKET</a>
                        </div>
                    </div>

                    <!-- Movie Card 3 -->
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/si-kasep.jpg') }}" alt="Si Kasep">
                            <div class="pre-sale-badge">PRE-SALE</div>
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Si Kasep</h3>
                            <a href="#" class="buy-ticket-btn">BELI TIKET</a>
                        </div>
                    </div>

                    <!-- Movie Card 4 -->
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/movie4.jpg') }}" alt="Movie 4">
                            <div class="pre-sale-badge">PRE-SALE</div>
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Aquaman and the Lost Kingdom</h3>
                            <a href="#" class="buy-ticket-btn">BELI TIKET</a>
                        </div>
                    </div>

                    <!-- Movie Card 5 -->
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/movie5.jpg') }}" alt="Movie 5">
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Wonka</h3>
                            <a href="#" class="buy-ticket-btn">BELI TIKET</a>
                        </div>
                    </div>

                    <!-- Movie Card 6 -->
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/movie6.jpg') }}" alt="Movie 6">
                            <div class="pre-sale-badge">PRE-SALE</div>
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Migration</h3>
                            <a href="#" class="buy-ticket-btn">BELI TIKET</a>
                        </div>
                    </div>

                    <!-- Movie Card 7 -->
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/movie7.jpg') }}" alt="Movie 7">
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Anyone But You</h3>
                            <a href="#" class="buy-ticket-btn">BELI TIKET</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 