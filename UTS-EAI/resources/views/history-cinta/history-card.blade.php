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
        .history-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .history-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .movie-poster {
            height: 200px;
            object-fit: cover;
        }
        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
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
        <h2 class="mb-4">Riwayat Pemesanan Tiket</h2>
        
        @if(isset($orders) && count($orders) > 0)
            <div class="row">
                @foreach($orders as $order)
                    <div class="col-md-6 col-lg-4">
                        <div class="card history-card">
                            <div class="position-relative">
                                <img src="{{ $order->movie_poster ?? asset('images/default-movie.jpg') }}" class="card-img-top movie-poster" alt="{{ $order->movie_title }}">
                                @if($order->status == 'completed')
                                    <span class="badge bg-success status-badge">Selesai</span>
                                @elseif($order->status == 'pending')
                                    <span class="badge bg-warning status-badge">Menunggu Pembayaran</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger status-badge">Dibatalkan</span>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $order->movie_title }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ $order->screening_date }}
                                    </small>
                                </p>
                                <p class="card-text">
                                    <i class="fas fa-ticket-alt me-1"></i> {{ $order->ticket_count }} Tiket
                                </p>
                                <p class="card-text">
                                    <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i> {{ $order->created_at->format('d M Y H:i') }}
                                    </small>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">ID: #{{ $order->id }}</span>
                                    <button class="btn btn-sm btn-outline-primary">Detail</button>
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