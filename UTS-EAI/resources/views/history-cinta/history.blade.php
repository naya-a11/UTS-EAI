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
            background-color: #141414;
            color: white;
        }
        .dashboard-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .section-header {
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e50914;
            color: white;
        }
        .section-header h3 {
            color: white;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }
        .section-header p {
            color: #e1e1e1;
            margin: 5px 0 0 0;
            font-size: 0.9rem;
        }
        .section-header p.text-muted {
            color: #e1e1e1 !important;
            opacity: 0.9;
        }
        .ticket-card {
            background-color: #1a1a1a;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            overflow: hidden;
            transition: transform 0.3s;
            border: none;
        }
        .ticket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }
        .ticket-header {
            padding: 1rem;
            border-bottom: 1px solid #2a2a2a;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .ticket-header .text-muted {
            color: #e1e1e1 !important;
            font-size: 0.9rem;
        }
        .ticket-body {
            padding: 1rem;
        }
        .ticket-footer {
            padding: 1rem;
            background-color: #1f1f1f;
            border-top: 1px solid #2a2a2a;
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
        .ticket-details {
            background-color: #1f1f1f;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }
        .ticket-details-item {
            display: flex;
            margin-bottom: 0.8rem;
            color: #e1e1e1;
        }
        .ticket-details-label {
            width: 140px;
            font-weight: 600;
            color: #e50914;
        }
        .ticket-details-value {
            flex: 1;
            color: #ffffff;
        }
        .ticket-card .text-muted {
            color: #e1e1e1 !important;
            opacity: 0.9;
        }
        .active-ticket {
            border-left: 4px solid #e50914;
        }
        .used-ticket {
            border-left: 4px solid #999;
        }
        .cancelled-ticket {
            border-left: 4px solid #dc3545;
        }
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 500;
        }
        .status-badge.bg-warning {
            background-color: #ffc107 !important;
            color: #000 !important;
            font-weight: 600;
        }
        .status-badge.bg-success {
            background-color: #28a745 !important;
            color: white !important;
            font-weight: 600;
        }
        .status-badge.bg-danger {
            background-color: #dc3545 !important;
            color: white !important;
            font-weight: 600;
        }
        .btn-outline-primary {
            color: #e50914;
            border-color: #e50914;
        }
        .btn-outline-primary:hover {
            background-color: #e50914;
            border-color: #e50914;
            color: white;
        }
        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }
        .btn-outline-danger:hover {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }
        .btn-outline-secondary {
            color: #999;
            border-color: #999;
        }
        .btn-outline-secondary:hover {
            background-color: #999;
            border-color: #999;
            color: white;
        }
        .alert-info {
            background-color: #1a1a1a;
            border-color: #2a2a2a;
            color: #e1e1e1;
        }
        .alert-info i {
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
                                        <img src="{{ $order->movie_poster }}" class="movie-poster me-3" alt="{{ $order->movie_title }}">
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
                                            <div class="ticket-details-value">{{ $order->cinema }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Studio:</div>
                                            <div class="ticket-details-value">{{ $order->studio }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Waktu Tayang:</div>
                                            <div class="ticket-details-value">{{ $order->screening_time }}</div>
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
                                        <img src="{{ $order->movie_poster }}" class="movie-poster me-3" alt="{{ $order->movie_title }}">
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
                                            <div class="ticket-details-value">{{ $order->cinema }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Studio:</div>
                                            <div class="ticket-details-value">{{ $order->studio }}</div>
                                        </div>
                                        <div class="ticket-details-item">
                                            <div class="ticket-details-label">Waktu Tayang:</div>
                                            <div class="ticket-details-value">{{ $order->screening_time }}</div>
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