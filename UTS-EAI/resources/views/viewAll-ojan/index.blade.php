<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Movies - Movie Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: #141414;
            color: white;
        }
        .movie-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            padding: 20px;
        }
        .movie-card {
            background: #1f1f1f;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .movie-card:hover {
            transform: translateY(-5px);
        }
        .movie-poster {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }
        .movie-info {
            padding: 15px;
        }
        .movie-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: white;
        }
        .movie-rating {
            color: #ffd700;
            margin-bottom: 10px;
        }
        .book-btn {
            background-color: #e50914;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            width: 100%;
            transition: background-color 0.3s;
        }
        .book-btn:hover {
            background-color: #ff0f1f;
            color: white;
        }
        .header {
            padding: 20px;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://source.unsplash.com/random/1920x1080/?cinema');
            background-size: cover;
            background-position: center;
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .search-bar {
            max-width: 500px;
            margin: 20px auto;
        }
        .filter-section {
            padding: 20px;
            background-color: #1f1f1f;
            margin-bottom: 30px;
        }
        .nav-tabs {
            border-bottom: 2px solid #e50914;
            margin-bottom: 30px;
        }
        .nav-tabs .nav-link {
            color: white;
            border: none;
            padding: 10px 20px;
            margin-right: 10px;
            border-radius: 5px 5px 0 0;
        }
        .nav-tabs .nav-link.active {
            background-color: #e50914;
            color: white;
            border: none;
        }
        .nav-tabs .nav-link:hover {
            border: none;
            background-color: rgba(229, 9, 20, 0.3);
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
        .movie-poster-container {
            position: relative;
        }
        .release-date {
            color: #e50914;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .back-to-home {
            display: inline-block;
            background-color: rgba(229, 9, 20, 0.8);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-bottom: 20px;
        }
        .back-to-home:hover {
            background-color: #e50914;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Movie Booking</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
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

    <div class="container mt-4">
        <a href="/" class="back-to-home">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
    </div>

    <div class="header">
        <h1>All Movies</h1>
        <div class="search-bar">
            <input type="text" class="form-control" placeholder="Search movies...">
        </div>
    </div>

    <div class="filter-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>All Genres</option>
                        <option>Action</option>
                        <option>Comedy</option>
                        <option>Drama</option>
                        <option>Horror</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Sort By</option>
                        <option>Latest</option>
                        <option>Rating</option>
                        <option>Title</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <ul class="nav nav-tabs" id="movieTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'now-showing' ? 'active' : '' }}" id="now-showing-tab" data-bs-toggle="tab" data-bs-target="#now-showing" type="button" role="tab">Now Showing</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'coming-soon' ? 'active' : '' }}" id="coming-soon-tab" data-bs-toggle="tab" data-bs-target="#coming-soon" type="button" role="tab">Coming Soon</button>
            </li>
        </ul>

        <div class="tab-content" id="movieTabsContent">
            <!-- Now Showing Tab -->
            <div class="tab-pane fade {{ $activeTab === 'now-showing' ? 'show active' : '' }}" id="now-showing" role="tabpanel">
                <div class="movie-grid">
                    <!-- Movie 1 -->
                    <div class="movie-card" data-movie-id="NS001" data-synopsis="Di sebuah pabrik gula tua yang sudah lama ditinggalkan, sekelompok remaja memutuskan untuk menghabiskan malam mereka. Namun, mereka tidak menyadari bahwa pabrik tersebut menyimpan rahasia mengerikan. Ketika mereka mulai menghilang satu per satu, mereka harus berjuang untuk bertahan hidup melawan entitas jahat yang menghantui pabrik tersebut.">
                        <div class="movie-poster-container">
                            <img src="{{ asset('images/movies/pabrik-gula.jpg') }}" alt="Pabrik Gula" class="movie-poster">
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Pabrik Gula</h3>
                            <div class="movie-genre">Horror</div>
                            <div class="movie-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <button class="book-btn" onclick="bookMovie('NS001')">Book Now</button>
                        </div>
                    </div>

                    <!-- Movie 2 -->
                    <div class="movie-card" data-movie-id="NS002" data-synopsis="Don (Prince Poetiray), anak gemuk yang sering diolok-olok dengan panggilan "Jumbo" ingin membalas perbuatan anak yang suka merundungnya, tapi sesosok arwah bernama Meri (Quinn Salman) meminta pertolongan Don untuk disatukan kembali dengan makam keluarganya yang dirusak.">
                        <div class="movie-poster-container">
                            <img src="{{ asset('images/movies/jumbo.jpg') }}" alt="Jumbo" class="movie-poster">
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Jumbo</h3>
                            <div class="movie-genre">Animation, Adventure</div>
                            <div class="movie-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <button class="book-btn" onclick="bookMovie('NS002')">Book Now</button>
                        </div>
                    </div>

                    <!-- Movie 3 -->
                    <div class="movie-card" data-movie-id="NS003" data-synopsis="Sebuah tim investigasi paranormal dipanggil untuk menyelidiki serangkaian kematian misterius di sebuah kota kecil. Saat mereka menggali lebih dalam, mereka menemukan bahwa setiap korban memiliki dosa masa lalu yang terhubung. Mereka harus menghadapi kekuatan jahat yang memburu mereka satu per satu, sambil mencoba mengungkap kebenaran di balik kutukan tersebut.">
                        <div class="movie-poster-container">
                            <img src="{{ asset('images/movies/sinners.jpg') }}" alt="Sinners" class="movie-poster">
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Sinners</h3>
                            <div class="movie-genre">Thriller, Horror</div>
                            <div class="movie-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <button class="book-btn" onclick="bookMovie('NS003')">Book Now</button>
                        </div>
                    </div>

                    <!-- Movie 4 -->
                    <div class="movie-card" data-movie-id="NS004" data-synopsis="Steve, seorang pemain Minecraft yang terobsesi dengan permainan, secara tidak sengaja terhisap ke dalam dunia Minecraft. Di sana, dia harus bertahan hidup dari berbagai monster dan bahaya sambil mencari cara untuk kembali ke dunia nyata. Bersama dengan teman-teman barunya, dia menjelajahi dunia blocks yang penuh petualangan dan misteri.">
                        <div class="movie-poster-container">
                            <img src="{{ asset('images/movies/minecraft.jpg') }}" alt="Minecraft" class="movie-poster">
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Minecraft</h3>
                            <div class="movie-genre">Action, Adventure</div>
                            <div class="movie-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <button class="book-btn" onclick="bookMovie('NS004')">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coming Soon Tab -->
            <div class="tab-pane fade {{ $activeTab === 'coming-soon' ? 'show active' : '' }}" id="coming-soon" role="tabpanel">
                <div class="movie-grid">
                    <!-- Movie 1 -->
                    <div class="movie-card" data-movie-id="CS001" data-synopsis="Di tengah konflik bersenjata yang memecah sebuah kota, dua keluarga dari pihak yang berbeda harus berjuang untuk bertahan hidup. Ketika anak-anak mereka terpisah dari keluarga, mereka harus mengesampingkan perbedaan mereka dan bekerja sama untuk menyelamatkan anak-anak mereka dari bahaya perang yang semakin mengancam.">
                        <div class="movie-poster-container">
                            <img src="{{ asset('images/movies/perang-kota.jpg') }}" alt="Perang Kota" class="movie-poster">
                            <div class="countdown-badge">Coming in 30 days</div>
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Perang Kota</h3>
                            <div class="release-date">Release: June 15, 2024</div>
                            <div class="movie-genre">Drama, War</div>
                            <button class="book-btn" onclick="bookMovie('CS001')">Pre-Book Now</button>
                        </div>
                    </div>

                    <!-- Movie 2 -->
                    <div class="movie-card" data-movie-id="CS002" data-synopsis="Sebuah tim fotografer profesional melakukan ekspedisi ke sebuah gunung terpencil untuk mengambil foto panorama yang sempurna. Namun, mereka tidak menyadari bahwa gunung tersebut adalah tempat suci yang dilindungi oleh makhluk-makhluk mistis. Ketika mereka mulai menghilang satu per satu, mereka harus menghadapi kenyataan bahwa mereka telah mengganggu sesuatu yang seharusnya tidak mereka ganggu.">
                        <div class="movie-poster-container">
                            <img src="{{ asset('images/movies/panor.jpg') }}" alt="Panor" class="movie-poster">
                            <div class="countdown-badge">Coming in 45 days</div>
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Panor</h3>
                            <div class="release-date">Release: July 1, 2024</div>
                            <div class="movie-genre">Horror</div>
                            <button class="book-btn" onclick="bookMovie('CS002')">Pre-Book Now</button>
                        </div>
                    </div>

                    <!-- Movie 3 -->
                    <div class="movie-card" data-movie-id="CS003" data-synopsis="Lima tahun setelah kejadian di film pertama, mantan pilot tempur yang kehilangan sayapnya kembali ke medan perang untuk menyelamatkan putrinya yang diculik oleh organisasi teroris. Dengan bantuan teman-teman lamanya, dia harus menghadapi masa lalunya dan mengorbankan segalanya untuk menyelamatkan putrinya.">
                        <div class="movie-poster-container">
                            <img src="{{ asset('images/movies/sayap-sayap-patah-2.jpg') }}" alt="Sayap-sayap Patah 2" class="movie-poster">
                            <div class="countdown-badge">Coming in 60 days</div>
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Sayap-sayap Patah 2</h3>
                            <div class="release-date">Release: July 15, 2024</div>
                            <div class="movie-genre">Drama, Action</div>
                            <button class="book-btn" onclick="bookMovie('CS003')">Pre-Book Now</button>
                        </div>
                    </div>

                    <!-- Movie 4 -->
                    <div class="movie-card" data-movie-id="CS004" data-synopsis="Sekelompok remaja yang selamat dari kecelakaan maut menemukan bahwa mereka telah menjadi target Death. Ketika mereka mulai mati satu per satu dengan cara yang tidak terduga, mereka harus bekerja sama untuk mengungkap pola kematian dan menemukan cara untuk mengelabui Death sebelum terlambat.">
                        <div class="movie-poster-container">
                            <img src="{{ asset('images/movies/final-destination.jpg') }}" alt="Final Destination Bloodlines" class="movie-poster">
                            <div class="countdown-badge">Coming in 90 days</div>
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title">Final Destination Bloodlines</h3>
                            <div class="release-date">Release: August 15, 2024</div>
                            <div class="movie-genre">Thriller</div>
                            <button class="book-btn" onclick="bookMovie('CS004')">Pre-Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function bookMovie(movieId) {
            window.location.href = `/details/${movieId}`;
        }
    </script>
</body>
</html> 