<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tickets - Movie Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: #141414;
            color: white;
        }
        .booking-container {
            background-color: #1a1a1a;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 4rem;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        .screen {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 0.2rem;
            margin-bottom: 2rem;
            border-radius: 5px;
            width: 100%;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #e50914;
        }
        .screen h3 {
            margin: 0;
            font-size: 1.2rem;
            padding: 0;
        }
        .seat {
            width: 35px;
            height: 35px;
            margin: 3px;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.8rem;
        }
        .seat.available {
            background-color: #28a745;
            color: white;
        }
        .seat.selected {
            background-color: #e50914;
            color: white;
        }
        .seat.occupied {
            background-color: #333;
            color: white;
            cursor: not-allowed;
            border: 1px solid #666;
        }
        .seat-legend {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: white;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        .legend-item .seat {
            width: 25px;
            height: 25px;
            margin: 0;
        }
        .footer-space {
            height: 60px;
        }
        .seat-row {
            display: flex;
            justify-content: center;
            margin-bottom: 5px;
        }
        .seat-row-label {
            width: 30px;
            text-align: center;
            margin-right: 10px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .seats-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 2rem;
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
        .card {
            background-color: #1f1f1f;
            border: none;
            border-radius: 10px;
        }
        .card-body {
            color: white;
        }
        .card-title {
            color: white;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }
        .proceed-btn {
            background-color: #e50914;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            width: 100%;
            transition: all 0.3s;
        }
        .proceed-btn:hover {
            background-color: #ff0f1f;
            color: white;
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

    <div class="container-fluid">
        <div class="booking-container">
            <div class="mb-4">
                <a href="/details/{{ $movieId }}" class="back-btn">
                    <i class="fas fa-arrow-left me-2"></i>Back to Movie Details
                </a>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <div class="seat-legend">
                        <div class="legend-item">
                            <div class="seat available"></div>
                            <span>Available</span>
                        </div>
                        <div class="legend-item">
                            <div class="seat selected"></div>
                            <span>Selected</span>
                        </div>
                        <div class="legend-item">
                            <div class="seat occupied"></div>
                            <span>Occupied</span>
                        </div>
                    </div>

                    <div class="screen">
                        <h3>SCREEN</h3>
                    </div>
                    
                    <div class="seats-container">
                        @for($row = 'A'; $row <= 'G'; $row++)
                            <div class="seat-row">
                                <div class="seat-row-label">{{ $row }}</div>
                                @for($seat = 1; $seat <= 20; $seat++)
                                    <div class="seat available" data-seat="{{ $row }}{{ $seat }}"
                                        @if($seat == 10) style="margin-right: 25px;" @endif>
                                        {{ $seat }}
                                    </div>
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Booking Summary</h5>
                            <div class="mb-3">
                                <h6>Movie: <span id="movie-title">Movie Title</span></h6>
                                <h6>Date: <span id="show-date">Today</span></h6>
                                <h6>Time: <span id="show-time">7:00 PM</span></h6>
                            </div>
                            <div class="mb-3">
                                <h6>Selected Seats:</h6>
                                <div id="selected-seats" class="mb-2"></div>
                            </div>
                            <div class="mb-3">
                                <h6>Total Price: <span id="total-price">$0</span></h6>
                            </div>
                            <button class="proceed-btn" id="proceed-payment">
                                Proceed to Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-space"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seats = document.querySelectorAll('.seat');
            const selectedSeatsContainer = document.getElementById('selected-seats');
            const totalPriceElement = document.getElementById('total-price');
            const movieTitleElement = document.getElementById('movie-title');
            let selectedSeats = [];
            const seatPrice = 10; // Price per seat

            // Get movie ID from URL
            const pathParts = window.location.pathname.split('/');
            const movieId = pathParts[pathParts.length - 1];

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

            // Update movie title
            if (movies[movieId]) {
                movieTitleElement.textContent = movies[movieId].title;
            }

            seats.forEach(seat => {
                if (!seat.classList.contains('occupied')) {
                    seat.addEventListener('click', function() {
                        const seatNumber = this.getAttribute('data-seat');
                        
                        if (this.classList.contains('selected')) {
                            this.classList.remove('selected');
                            selectedSeats = selectedSeats.filter(s => s !== seatNumber);
                        } else {
                            this.classList.add('selected');
                            selectedSeats.push(seatNumber);
                        }
                        
                        updateBookingSummary();
                    });
                }
            });

            function updateBookingSummary() {
                selectedSeatsContainer.innerHTML = selectedSeats.join(', ');
                totalPriceElement.textContent = `$${selectedSeats.length * seatPrice}`;
            }

            document.getElementById('proceed-payment').addEventListener('click', function() {
                if (selectedSeats.length === 0) {
                    alert('Please select at least one seat');
                    return;
                }
                // Here you would typically redirect to payment page
                alert('Proceeding to payment...');
            });
        });

        function handleMoviesClick(event) {
            if (window.location.pathname === '/') {
                event.preventDefault();
                window.location.reload();
            }
        }
    </script>
</body>
</html> 