<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moononton</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .carousel-item {
            height: 600px;
            background-position: center;
            background-size: cover;
            position: relative;
        }
        .carousel-caption {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            bottom: 50px;
        }
        .book-now-btn {
            background-color: #e50914;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .book-now-btn:hover {
            background-color: #ff0f1f;
            color: white;
        }
        .carousel-control-prev, .carousel-control-next {
            width: 5%;
        }
        /* New Styles for Now Showing Section */
        .now-showing {
            padding: 50px 0;
            background-color: #141414;
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .section-title {
            color: white;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }
        .view-all-btn {
            background-color: transparent;
            color: #e50914;
            border: 2px solid #e50914;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .view-all-btn:hover {
            background-color: #e50914;
            color: white;
        }
        .movie-card {
            background-color: #1a1a1a;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .movie-card:hover {
            transform: translateY(-5px);
        }
        .movie-poster {
            position: relative;
            overflow: hidden;
            padding-top: 150%;
        }
        .movie-poster img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .movie-info {
            padding: 15px;
            color: white;
        }
        .movie-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: white;
            text-decoration: none;
        }
        .movie-genre {
            color: #999;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .movie-rating {
            color: #ffd700;
            margin-bottom: 15px;
        }
        /* Additional styles for Coming Soon section */
        .coming-soon {
            padding: 50px 0;
            background-color: #0a0a0a;
        }
        .coming-soon .movie-card {
            background-color: #1f1f1f;
        }
        .release-date {
            color: #e50914;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .countdown-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(229, 9, 20, 0.9);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
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

    <!-- Movie Carousel -->
    <div id="movieCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#movieCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#movieCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#movieCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#movieCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('{{ asset('images/movies/pabrik-gula.jpg') }}');">
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Pabrik Gula</h1>
                        <p>Sebuah kisah horor mencekam yang akan membuat Anda tegang sepanjang film.</p>
                        <p><a class="book-now-btn" href="#" onclick="bookMovie('NS001')">Book Now</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('{{ asset('images/movies/jumbo.jpg') }}');">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Jumbo</h1>
                        <p>Petualangan animasi yang mengharukan dan penuh keajaiban.</p>
                        <p><a class="book-now-btn" href="#" onclick="bookMovie('NS002')">Book Now</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('{{ asset('images/movies/sinners.jpg') }}');">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Sinners</h1>
                        <p>From Ryan Coogler, director of Black Panther and Creed comes an epic thriller.</p>
                        <p><a class="book-now-btn" href="#" onclick="bookMovie('NS003')">Book Now</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('{{ asset('images/movies/minecraft.jpg') }}');">
                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>Minecraft</h1>
                        <p>Petualangan epik dalam dunia blocks yang penuh aksi.</p>
                        <p><a class="book-now-btn" href="#" onclick="bookMovie('NS004')">Book Now</a></p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#movieCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#movieCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Now Showing Section -->
    <section class="now-showing">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Now Showing</h2>
                <a href="{{ route('movies.view-all') }}" class="view-all-btn">VIEW ALL</a>
            </div>
            <div class="row">
                <!-- Movie 1 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/movies/pabrik-gula.jpg') }}" alt="Pabrik Gula">
                        </div>
                        <div class="movie-info">
                            <a href="#" class="movie-title">Pabrik Gula</a>
                            <div class="movie-genre">Horror</div>
                            <div class="movie-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <a href="{{ route('movie.details', ['id' => 'NS001']) }}" class="book-now-btn w-100 text-center">Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Movie 2 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/movies/jumbo.jpg') }}" alt="Jumbo">
                        </div>
                        <div class="movie-info">
                            <a href="#" class="movie-title">Jumbo</a>
                            <div class="movie-genre">Animation, Adventure</div>
                            <div class="movie-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <a href="{{ route('movie.details', ['id' => 'NS002']) }}" class="book-now-btn w-100 text-center">Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Movie 3 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/movies/sinners.jpg') }}" alt="Sinners">
                        </div>
                        <div class="movie-info">
                            <a href="#" class="movie-title">Sinners</a>
                            <div class="movie-genre">Thriller, Horror</div>
                            <div class="movie-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <a href="{{ route('movie.details', ['id' => 'NS003']) }}" class="book-now-btn w-100 text-center">Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Movie 4 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/movies/minecraft.jpg') }}" alt="Minecraft">
                        </div>
                        <div class="movie-info">
                            <a href="#" class="movie-title">Minecraft</a>
                            <div class="movie-genre">Action, Adventure</div>
                            <div class="movie-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <a href="{{ route('movie.details', ['id' => 'NS004']) }}" class="book-now-btn w-100 text-center">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Coming Soon Section -->
    <section class="coming-soon">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Coming Soon</h2>
                <a href="{{ route('movies.view-all', ['tab' => 'coming-soon']) }}" class="view-all-btn">VIEW ALL</a>
            </div>
            <div class="row">
                <!-- Movie 1 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/movies/perang-kota.jpg') }}" alt="Perang Kota">
                            <div class="countdown-badge">Coming in 30 days</div>
                        </div>
                        <div class="movie-info">
                            <a href="#" class="movie-title">Perang Kota</a>
                            <div class="release-date">Release: June 15, 2024</div>
                            <div class="movie-genre">Drama, War</div>
                            <a href="{{ route('movie.details', ['id' => 'CS001']) }}" class="book-now-btn w-100 text-center">Pre-Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Movie 2 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/movies/panor.jpg') }}" alt="Panor">
                            <div class="countdown-badge">Coming in 45 days</div>
                        </div>
                        <div class="movie-info">
                            <a href="#" class="movie-title">Panor</a>
                            <div class="release-date">Release: July 1, 2024</div>
                            <div class="movie-genre">Horror</div>
                            <a href="{{ route('movie.details', ['id' => 'CS002']) }}" class="book-now-btn w-100 text-center">Pre-Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Movie 3 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/movies/sayap-sayap-patah-2.jpg') }}" alt="Sayap-sayap Patah 2">
                            <div class="countdown-badge">Coming in 60 days</div>
                        </div>
                        <div class="movie-info">
                            <a href="#" class="movie-title">Sayap-sayap Patah 2</a>
                            <div class="release-date">Release: July 15, 2024</div>
                            <div class="movie-genre">Drama, Action</div>
                            <a href="{{ route('movie.details', ['id' => 'CS003']) }}" class="book-now-btn w-100 text-center">Pre-Book Now</a>
                        </div>
                    </div>
                </div>
                <!-- Movie 4 -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="movie-card">
                        <div class="movie-poster">
                            <img src="{{ asset('images/movies/final-destination.jpg') }}" alt="Final Destination Bloodlines">
                            <div class="countdown-badge">Coming in 90 days</div>
                        </div>
                        <div class="movie-info">
                            <a href="#" class="movie-title">Final Destination Bloodlines</a>
                            <div class="release-date">Release: August 15, 2024</div>
                            <div class="movie-genre">Thriller</div>
                            <a href="{{ route('movie.details', ['id' => 'CS004']) }}" class="book-now-btn w-100 text-center">Pre-Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function handleMoviesClick(event) {
            if (window.location.pathname === '/') {
                event.preventDefault();
                window.location.reload();
            }
        }

        function bookMovie(movieId) {
            window.location.href = `/details/${movieId}`;
        }
    </script>
</body>
</html>