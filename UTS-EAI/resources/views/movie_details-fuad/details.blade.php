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
        body {
            background-color: #141414;
            color: white;
        }
        .movie-details {
            background-color: #1a1a1a;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 4rem;
        }
        .poster-container {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
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
            background-color: #e50914;
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
            background-color: #0a0a0a;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            color: white;
        }
        .btn-primary {
            background-color: #e50914;
            border-color: #e50914;
        }
        .btn-primary:hover {
            background-color: #ff0f1f;
            border-color: #ff0f1f;
        }
        .btn-outline-dark {
            color: white;
            border-color: #333;
        }
        .btn-outline-dark:hover {
            background-color: #333;
            color: white;
        }
        .badge {
            background-color: #333;
            color: white;
        }
        .text-muted {
            color: #999 !important;
        }
        .list-group-item {
            background-color: #1a1a1a;
            border-color: #333;
            color: white;
        }
        .list-group-item:hover {
            background-color: #333;
        }
        .footer-space {
            height: 60px;
        }
        .book-now-btn {
            background-color: #e50914;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            width: 100%;
            text-align: center;
        }
        .book-now-btn:hover {
            background-color: #ff0f1f;
            color: white;
        }
        .back-btn {
            background-color: transparent;
            color: #e50914;
            border: 2px solid #e50914;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .back-btn:hover {
            background-color: #e50914;
            color: white;
        }
        .badge {
            background-color: #e50914;
            color: white;
        }
        .text-muted {
            color: #999 !important;
        }
        .list-group-item {
            background-color: #1f1f1f;
            border-color: #333;
            color: white;
        }
        .list-group-item:hover {
            background-color: #2a2a2a;
        }
        .border-bottom {
            border-color: #333 !important;
        .movie-title {
            color: white;
            text-decoration: none;
        }
        .movie-title:hover {
            color: #e50914;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Moononton</a>
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
                <a href="#" class="back-btn" onclick="handleBackClick(event)">
                    <i class="fas fa-arrow-left me-2"></i>Back to Movies
                </a>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="poster-container">
                        <img id="moviePoster" src="" alt="Movie Poster" class="img-fluid">
                    </div>
                    <div class="mt-4 text-center">
                        <div class="d-grid">
                            <a href="{{ route('movie.booking', ['id' => $movieId]) }}" id="bookNowBtn" class="book-now-btn">
                                <i class="fas fa-ticket-alt me-2"></i>Book Tickets
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="title-rating">
                        <h1 class="display-4 mb-3" id="movieTitle">Loading...</h1>
                        <div class="rating-circle" id="movieRating">0.0</div>
                    </div>
                    <div class="mb-4" id="movieGenres">
                        <!-- Genres will be populated here -->
                    </div>
                    <div class="detail-section">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <small class="text-muted">Duration</small>
                                <p class="mb-0"><i class="fas fa-clock me-2"></i><span id="movieDuration">Loading...</span></p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Release Date</small>
                                <p class="mb-0"><i class="fas fa-calendar me-2"></i><span id="movieReleaseDate">Loading...</span></p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Rating</small>
                                <p class="mb-0"><i class="fas fa-star me-2"></i><span id="movieAgeRating">Loading...</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Synopsis</h5>
                        <p class="lead" id="movieSynopsis">Loading...</p>
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

        function handleBackClick(event) {
            event.preventDefault();
            const movieId = '{{ $movieId }}';
            
            // Get the previous page from session storage or default to home
            const previousPage = sessionStorage.getItem('previousPage') || '/';
            
            // If coming from booking page, go to home page
            if (previousPage.includes('/booking/')) {
                window.location.href = '/';
                return;
            }
            
            if (previousPage.includes('/view-all-movies')) {
                // If coming from view all page, include the tab parameter
                const tab = previousPage.includes('coming-soon') ? 'coming-soon' : 'now-showing';
                window.location.href = `/view-all-movies/${tab}?movieId=${movieId}`;
            } else {
                // For home page or other pages
                window.location.href = previousPage;
            }
        }

        // Store the current page as the previous page when details page loads
        window.onload = function() {
            // Only store the previous page if it's not the booking page
            const previousPage = document.referrer;
            if (!previousPage.includes('/booking/')) {
                sessionStorage.setItem('previousPage', previousPage);
            }
        };

        // Get movie ID from route parameter
        const movieId = '{{ $movieId }}';

        // Movie data mapping
        const movies = {
            'NS001': {
                title: 'Pabrik Gula',
                poster: '{{ asset("images/movies/pabrik-gula.jpg") }}',
                rating: 4.0,
                genres: ['Horror'],
                duration: '1h 45min',
                releaseDate: 'May 1, 2024',
                ageRating: 'R',
                synopsis: 'Di sebuah pabrik gula tua yang sudah lama ditinggalkan, sekelompok remaja memutuskan untuk menghabiskan malam mereka. Namun, mereka tidak menyadari bahwa pabrik tersebut menyimpan rahasia mengerikan.'
            },
            'NS002': {
                title: 'Jumbo',
                poster: '{{ asset("images/movies/jumbo.jpg") }}',
                rating: 5.0,
                genres: ['Animation', 'Adventure'],
                duration: '1h 30min',
                releaseDate: 'May 15, 2024',
                ageRating: 'PG',
                synopsis: 'Don (Prince Poetiray), anak gemuk yang sering diolok-olok dengan panggilan "Jumbo" ingin membalas perbuatan anak yang suka merundungnya.'
            },
            'NS003': {
                title: 'Sinners',
                poster: '{{ asset("images/movies/sinners.jpg") }}',
                rating: 4.5,
                genres: ['Thriller', 'Horror'],
                duration: '2h 15min',
                releaseDate: 'June 1, 2024',
                ageRating: 'R',
                synopsis: 'Sebuah tim investigasi paranormal dipanggil untuk menyelidiki serangkaian kematian misterius di sebuah kota kecil.'
            },
            'NS004': {
                title: 'Minecraft',
                poster: '{{ asset("images/movies/minecraft.jpg") }}',
                rating: 4.5,
                genres: ['Action', 'Adventure'],
                duration: '2h 30min',
                releaseDate: 'June 15, 2024',
                ageRating: 'PG-13',
                synopsis: 'Steve, seorang pemain Minecraft yang terobsesi dengan permainan, secara tidak sengaja terhisap ke dalam dunia Minecraft.'
            }
        };

        // Function to update movie details
        function updateMovieDetails(movieId) {
            const movie = movies[movieId];
            if (!movie) {
                // Handle case when movie is not found
                document.getElementById('movieTitle').textContent = 'Movie Not Found';
                return;
            }

            // Update basic information
            document.getElementById('movieTitle').textContent = movie.title;
            document.getElementById('moviePoster').src = movie.poster;
            document.getElementById('movieRating').textContent = movie.rating;
            document.getElementById('movieDuration').textContent = movie.duration;
            document.getElementById('movieReleaseDate').textContent = movie.releaseDate;
            document.getElementById('movieAgeRating').textContent = movie.ageRating;
            document.getElementById('movieSynopsis').textContent = movie.synopsis;

            // Update genres
            const genresContainer = document.getElementById('movieGenres');
            genresContainer.innerHTML = movie.genres.map(genre => 
                `<span class="badge bg-dark me-2">${genre}</span>`
            ).join('');

            // Update book now button
            const bookNowBtn = document.getElementById('bookNowBtn');
            bookNowBtn.href = `/booking/${movieId}`;
        }

        // Initialize movie details when page loads
        if (movieId) {
            updateMovieDetails(movieId);
        } else {
            // Handle case when no movie ID is provided
            document.getElementById('movieTitle').textContent = 'No Movie Selected';
        }
    </script>
</body>
</html> 