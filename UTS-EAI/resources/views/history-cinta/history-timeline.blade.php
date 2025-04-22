<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History - Moononton</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .timeline {
            position: relative;
            padding: 20px 0;
        }
        .timeline::before {
            content: '';
            position: absolute;
            width: 2px;
            background-color: #e9ecef;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -1px;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }
        .timeline-content {
            position: relative;
            width: 45%;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .timeline-item:nth-child(odd) .timeline-content {
            float: left;
        }
        .timeline-item:nth-child(even) .timeline-content {
            float: right;
        }
        .timeline-date {
            position: absolute;
            top: 0;
            width: 100px;
            text-align: center;
            background: #343a40;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
        }
        .timeline-item:nth-child(odd) .timeline-date {
            right: -120px;
        }
        .timeline-item:nth-child(even) .timeline-date {
            left: -120px;
        }
        .timeline-icon {
            position: absolute;
            width: 40px;
            height: 40px;
            background: #343a40;
            border-radius: 50%;
            top: 20px;
            left: 50%;
            margin-left: -20px;
            text-align: center;
            line-height: 40px;
            color: #fff;
            z-index: 1;
        }
        .movie-poster-small {
            width: 80px;
            height: 120px;
            object-fit: cover;
            border-radius: 4px;
        }
        @media (max-width: 767px) {
            .timeline::before {
                left: 40px;
            }
            .timeline-content {
                width: calc(100% - 90px);
                float: right !important;
            }
            .timeline-date {
                left: 90px !important;
                right: auto !important;
            }
            .timeline-icon {
                left: 20px;
            }
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
                        <a class="nav-link active" href="{{ route('history.index') }}">
                            <i class="fas fa-history"></i> History
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Riwayat Pemesanan Tiket</h2>
        
        @if(isset($orders) && count($orders) > 0)
            <div class="timeline">
                @foreach($orders as $order)
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="timeline-date">
                            {{ $order->created_at->format('d M Y') }}
                        </div>
                        <div class="timeline-content">
                            <div class="d-flex">
                                <img src="{{ $order->movie_poster ?? asset('images/default-movie.jpg') }}" class="movie-poster-small me-3" alt="{{ $order->movie_title }}">
                                <div>
                                    <h5>{{ $order->movie_title }}</h5>
                                    <p class="mb-1">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ $order->screening_date }}
                                    </p>
                                    <p class="mb-1">
                                        <i class="fas fa-ticket-alt me-1"></i> {{ $order->ticket_count }} Tiket
                                    </p>
                                    <p class="mb-1">
                                        <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                                    </p>
                                    <p class="mb-1">
                                        <small class="text-muted">ID: #{{ $order->id }}</small>
                                    </p>
                                    @if($order->status == 'completed')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($order->status == 'pending')
                                        <span class="badge bg-warning">Menunggu Pembayaran</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> Anda belum memiliki riwayat pemesanan tiket.
            </div>
        @endif
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