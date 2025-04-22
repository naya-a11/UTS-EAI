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
        .booking-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
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
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 5px;
            width: 100%;
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
            background-color: #007bff;
            color: white;
        }
        .seat.occupied {
            background-color: #dc3545;
            color: white;
            cursor: not-allowed;
        }
        .seat-legend {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
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
        }
        .seats-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 2rem;
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

    <div class="container-fluid">
        <div class="booking-container">
            <div class="mb-4">
                <a href="{{ route('movie.details') }}" class="btn btn-outline-dark">
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
                            <button class="btn btn-primary w-100" id="proceed-payment">
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
            let selectedSeats = [];
            const seatPrice = 10; // Price per seat

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