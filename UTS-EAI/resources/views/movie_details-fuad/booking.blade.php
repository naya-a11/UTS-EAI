<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tickets - {{ $movie->title }}</title>
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
        }
        .movie-info {
            background-color: #0a0a0a;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .movie-info h2 {
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        .form-control {
            background-color: #1a1a1a;
            border-color: #333;
            color: white;
        }
        .form-control:focus {
            background-color: #1a1a1a;
            border-color: #e50914;
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(229, 9, 20, 0.25);
        }
        .btn-primary {
            background-color: #e50914;
            border-color: #e50914;
        }
        .btn-primary:hover {
            background-color: #ff0f1f;
            border-color: #ff0f1f;
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
        .price-info {
            background-color: #141414;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #333;
        }
        .price-info p {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }
        .price-info p:last-child {
            margin-bottom: 0;
        }
        .price-label {
            color: #999;
        }
        .price-value {
            font-weight: 500;
        }
        .total-price {
            font-size: 1.4rem !important;
            font-weight: bold !important;
            color: #0d6efd;
            border-top: 1px solid #333;
            padding-top: 1rem;
            margin-top: 1rem !important;
        }
        .seat-map {
            background-color: #0a0a0a;
            border-radius: 15px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .screen {
            background: linear-gradient(to bottom, #333, #1a1a1a);
            color: #999;
            text-align: center;
            padding: 1rem;
            margin-bottom: 3rem;
            border-radius: 5px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
        }
        .screen::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 20px;
            background: linear-gradient(to bottom, rgba(51, 51, 51, 0.2), transparent);
        }
        .seats-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 2rem;
            align-items: center;
            padding: 1rem;
        }
        .seat-row {
            display: flex;
            gap: 10px;
        }
        .row-label {
            width: 30px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .seat {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .seat.available {
            background-color: #1a1a1a;
            border: 2px solid #333;
        }
        .seat.available:hover {
            background-color: #0d6efd33;
            border-color: #0d6efd;
            transform: scale(1.1);
        }
        .seat.selected {
            background-color: #0d6efd;
            border: 2px solid #0d6efd;
            color: white;
            transform: scale(1.05);
        }
        .seat-row .seat:nth-child(12) {
            margin-left: 20px;
        }
        .btn-proceed {
            width: 100%;
            padding: 1rem;
            font-size: 1.2rem;
            font-weight: 600;
            transition: all 0.3s;
            border-radius: 12px;
        }
        .btn-proceed.disabled {
            background-color: #333;
            border-color: #333;
            cursor: not-allowed;
            opacity: 0.7;
        }
        .btn-proceed.enabled {
            background-color: #0d6efd;
            border-color: #0d6efd;
            box-shadow: 0 4px 6px rgba(13, 110, 253, 0.2);
        }
        .btn-proceed.enabled:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(13, 110, 253, 0.3);
        }
        .legend {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
            padding: 1rem;
            background-color: #141414;
            border-radius: 10px;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #999;
            font-size: 0.9rem;
        }
        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
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

    <div class="container">
        <div class="booking-container">
            <div class="mb-4">
                <a href="{{ route('movie.details', ['id' => $movieId]) }}" class="back-btn">
                    <i class="fas fa-arrow-left me-2"></i>Back to Movie Details
                </a>
            </div>

            <div class="movie-info">
                <h2>{{ $movie->title }}</h2>
                <div class="price-info">
                    <p>
                        <span class="price-label"><i class="fas fa-tag me-2"></i>Price per seat</span>
                        <span class="price-value">IDR 60,000</span>
                    </p>
                    <p>
                        <span class="price-label"><i class="fas fa-chair me-2"></i>Selected seats</span>
                        <span class="price-value"><span id="selectedSeatsCount">0</span> seats</span>
                    </p>
                    <p class="total-price">
                        <span class="price-label">Total Amount</span>
                        <span class="price-value">IDR <span id="totalPrice">0</span></span>
                    </p>
                </div>
            </div>

            <div class="seat-map">
                <div class="screen">
                    <i class="fas fa-film me-2"></i>Screen
                </div>
                <div class="seats-container" id="seatsContainer">
                    @foreach(range('A', 'H') as $row)
                        <div class="seat-row">
                            <div class="row-label">{{ $row }}</div>
                            @for($i = 1; $i <= 20; $i++)
                                @php
                                    $seatNumber = $row . $i;
                                @endphp
                                <div class="seat available" 
                                     data-seat="{{ $seatNumber }}"
                                     onclick="toggleSeat(this)">
                                    {{ $i }}
                                </div>
                            @endfor
                        </div>
                    @endforeach
                </div>
                <div class="legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #1a1a1a; border: 2px solid #333;"></div>
                        <span>Available</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #0d6efd; border: 2px solid #0d6efd;"></div>
                        <span>Selected</span>
                    </div>
                </div>
            </div>

            <div class="d-grid">
                <form action="{{ route('payment.index') }}" method="GET" id="bookingForm">
                    <input type="hidden" name="selectedSeats" id="selectedSeatsInput">
                    <input type="hidden" name="totalPrice" id="totalPriceInput">
                    <input type="hidden" name="movieId" value="{{ $movieId }}">
                    <button type="submit" class="btn btn-proceed disabled" id="proceedButton" disabled>
                        <i class="fas fa-shopping-cart me-2"></i>Proceed to Payment
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let selectedSeats = [];
        const PRICE_PER_SEAT = 60000;

        function formatPrice(price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function updatePriceInfo() {
            const selectedSeatsCount = document.getElementById('selectedSeatsCount');
            const totalPrice = document.getElementById('totalPrice');
            const total = selectedSeats.length * PRICE_PER_SEAT;

            selectedSeatsCount.textContent = selectedSeats.length;
            totalPrice.textContent = formatPrice(total);

            // Update hidden form inputs
            document.getElementById('selectedSeatsInput').value = JSON.stringify(selectedSeats);
            document.getElementById('totalPriceInput').value = total;
        }

        function toggleSeat(seatElement) {
            const seatNumber = seatElement.dataset.seat;
            const index = selectedSeats.indexOf(seatNumber);

            if (index === -1) {
                if (selectedSeats.length >= 10) {
                    alert('You can select maximum 10 seats');
                    return;
                }
                selectedSeats.push(seatNumber);
                seatElement.classList.add('selected');
                seatElement.classList.remove('available');
            } else {
                selectedSeats.splice(index, 1);
                seatElement.classList.remove('selected');
                seatElement.classList.add('available');
            }

            updatePriceInfo();

            const proceedButton = document.getElementById('proceedButton');
            if (selectedSeats.length > 0) {
                proceedButton.disabled = false;
                proceedButton.classList.remove('disabled');
                proceedButton.classList.add('enabled');
            } else {
                proceedButton.disabled = true;
                proceedButton.classList.remove('enabled');
                proceedButton.classList.add('disabled');
            }
        }

        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            if (selectedSeats.length === 0) {
                e.preventDefault();
                alert('Please select at least one seat');
                return;
            }
        });
    </script>
</body>
</html> 