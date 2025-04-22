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
        .ticket-card {
            background: white;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: transform 0.3s;
        }
        .ticket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .ticket-header {
            padding: 1rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .ticket-body {
            padding: 1rem;
        }
        .ticket-footer {
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
        .section-header {
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 500;
        }
        .ticket-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }
        .ticket-details-item {
            display: flex;
            margin-bottom: 0.5rem;
        }
        .ticket-details-label {
            width: 120px;
            font-weight: 600;
            color: #6c757d;
        }
        .ticket-details-value {
            flex: 1;
        }
        .active-ticket {
            border-left: 4px solid #0d6efd;
        }
        .used-ticket {
            border-left: 4px solid #6c757d;
        }
        .cancelled-ticket {
            border-left: 4px solid #dc3545;
        }
        .ticket-qr {
            width: 100px;
            height: 100px;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            margin: 0 auto;
        }
        .ticket-qr i {
            font-size: 2rem;
            color: #6c757d;
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
            <!-- Active Tickets Section -->
            <div class="section-header">
                <h3><i class="fas fa-ticket-alt me-2"></i> Tiket Aktif</h3>
                <p class="text-muted">Tiket yang baru dipesan dan belum digunakan</p>
            </div>

            @php
                $activeTickets = $orders->where('status', 'pending')->sortByDesc('created_at');
            @endphp

            @if($activeTickets->count() > 0)
                <div class="row">
                    @foreach($activeTickets as $order)
                        <div class="col-md-6">
                            <div class="ticket-card active-ticket">
                                <div class="ticket-header">
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
                                        <span class="status-badge bg-warning text-dark">Menunggu Pembayaran</span>
                                    </div>
                                </div>
                                <div class="ticket-body">
                                    <div class="ticket-details">
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">ID Pesanan:</div>
                                            <div class="ticket-details-value">#{{ $order->id }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Jumlah Tiket:</div>
                                            <div class="ticket-details-value">{{ $order->ticket_count }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Total Harga:</div>
                                            <div class="ticket-details-value">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Bioskop:</div>
                                            <div class="ticket-details-value">{{ $order->cinema ?? 'Moononton Cinema' }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Studio:</div>
                                            <div class="ticket-details-value">{{ $order->studio ?? 'Studio 1' }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Waktu Tayang:</div>
                                            <div class="ticket-details-value">{{ $order->screening_time ?? '19:00' }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Tanggal Pemesanan:</div>
                                            <div class="ticket-details-value">{{ $order->created_at->format('d M Y H:i') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ticket-footer">
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary">Lihat Detail</button>
                                        <button class="btn btn-sm btn-outline-danger ms-2">Batalkan Pesanan</button>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-download me-1"></i> Unduh Tiket
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> Anda tidak memiliki tiket aktif.
                </div>
            @endif

            <!-- Used Tickets Section -->
            <div class="section-header mt-5">
                <h3><i class="fas fa-history me-2"></i> Riwayat Tiket</h3>
                <p class="text-muted">Tiket yang sudah digunakan atau dibatalkan</p>
            </div>

            @php
                $usedTickets = $orders->where('status', 'completed')->sortByDesc('created_at');
                $cancelledTickets = $orders->where('status', 'cancelled')->sortByDesc('created_at');
                $allUsedTickets = $usedTickets->concat($cancelledTickets);
            @endphp

            @if($allUsedTickets->count() > 0)
                <div class="row">
                    @foreach($allUsedTickets as $order)
                        <div class="col-md-6">
                            <div class="ticket-card {{ $order->status == 'completed' ? 'used-ticket' : 'cancelled-ticket' }}">
                                <div class="ticket-header">
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
                                        @elseif($order->status == 'cancelled')
                                            <span class="status-badge bg-danger text-white">Dibatalkan</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="ticket-body">
                                    <div class="ticket-details">
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">ID Pesanan:</div>
                                            <div class="ticket-details-value">#{{ $order->id }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Jumlah Tiket:</div>
                                            <div class="ticket-details-value">{{ $order->ticket_count }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Total Harga:</div>
                                            <div class="ticket-details-value">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Bioskop:</div>
                                            <div class="ticket-details-value">{{ $order->cinema ?? 'Moononton Cinema' }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Studio:</div>
                                            <div class="ticket-details-value">{{ $order->studio ?? 'Studio 1' }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Waktu Tayang:</div>
                                            <div class="ticket-details-value">{{ $order->screening_time ?? '19:00' }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Tanggal Pemesanan:</div>
                                            <div class="ticket-details-value">{{ $order->created_at->format('d M Y H:i') }}</div>
                                        </div>
                                        @if($order->status == 'completed')
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Tanggal Digunakan:</div>
                                            <div class="ticket-details-value">{{ $order->used_at ?? $order->screening_date }}</div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="ticket-footer">
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary">Lihat Detail</button>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-download me-1"></i> Unduh Tiket
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> Anda belum memiliki riwayat tiket.
                </div>
            @endif
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