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
        body {
            background-color: #f8f9fa;
        }
        .dashboard-header {
            background: linear-gradient(135deg, #343a40 0%, #212529 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .stats-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .stats-number {
            font-size: 1.8rem;
            font-weight: bold;
        }
        .order-card {
            background: white;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .order-header {
            padding: 1rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .order-body {
            padding: 1rem;
        }
        .order-footer {
            padding: 1rem;
            background-color: #f8f9fa;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .movie-poster {
            width: 100px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }
        .filter-section {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 500;
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

    <div class="dashboard-header">
        <div class="container">
            <h1>Riwayat Pemesanan Tiket</h1>
            <p class="mb-0">Lihat semua riwayat pemesanan tiket film Anda</p>
        </div>
    </div>

    <div class="container">
        @if(isset($orders) && count($orders) > 0)
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stats-card text-primary">
                        <div class="stats-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div class="stats-number">{{ count($orders) }}</div>
                        <div class="stats-label">Total Pesanan</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card text-success">
                        <div class="stats-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stats-number">{{ $orders->where('status', 'completed')->count() }}</div>
                        <div class="stats-label">Pesanan Selesai</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card text-warning">
                        <div class="stats-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stats-number">{{ $orders->where('status', 'pending')->count() }}</div>
                        <div class="stats-label">Menunggu Pembayaran</div>
                    </div>
                </div>
            </div>

            <div class="filter-section mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-0">Filter Pesanan</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-md-end">
                            <select class="form-select me-2" style="width: auto;">
                                <option value="all">Semua Status</option>
                                <option value="completed">Selesai</option>
                                <option value="pending">Menunggu Pembayaran</option>
                                <option value="cancelled">Dibatalkan</option>
                            </select>
                            <select class="form-select" style="width: auto;">
                                <option value="newest">Terbaru</option>
                                <option value="oldest">Terlama</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="orders-list">
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <div class="d-flex align-items-center">
                                <img src="{{ $order->movie_poster ?? asset('images/default-movie.jpg') }}" class="movie-poster me-3" alt="{{ $order->movie_title }}">
                                <div>
                                    <h5 class="mb-1">{{ $order->movie_title }}</h5>
                                    <p class="mb-0 text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ $order->screening_date }}
                                    </p>
                                </div>
                            </div>
                            <div>
                                @if($order->status == 'completed')
                                    <span class="status-badge bg-success text-white">Selesai</span>
                                @elseif($order->status == 'pending')
                                    <span class="status-badge bg-warning text-dark">Menunggu Pembayaran</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="status-badge bg-danger text-white">Dibatalkan</span>
                                @endif
                            </div>
                        </div>
                        <div class="order-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>ID Pesanan:</strong> #{{ $order->id }}</p>
                                    <p><strong>Jumlah Tiket:</strong> {{ $order->ticket_count }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    <p><strong>Tanggal Pemesanan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="order-footer">
                            <div>
                                <button class="btn btn-sm btn-outline-primary">Lihat Detail</button>
                                @if($order->status == 'pending')
                                    <button class="btn btn-sm btn-outline-danger ms-2">Batalkan Pesanan</button>
                                @endif
                            </div>
                            <div>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-download me-1"></i> Unduh Tiket
                                </button>
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