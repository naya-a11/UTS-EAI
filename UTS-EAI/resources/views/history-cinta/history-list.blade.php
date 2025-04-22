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
        .history-list-item {
            border-left: 4px solid #343a40;
            margin-bottom: 15px;
            transition: all 0.3s;
        }
        .history-list-item:hover {
            border-left-color: #0d6efd;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .history-list-item.completed {
            border-left-color: #198754;
        }
        .history-list-item.pending {
            border-left-color: #ffc107;
        }
        .history-list-item.cancelled {
            border-left-color: #dc3545;
        }
        .history-list-header {
            cursor: pointer;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        .history-list-content {
            padding: 15px;
            display: none;
            background-color: #fff;
            border-radius: 0 0 4px 4px;
        }
        .history-list-content.active {
            display: block;
        }
        .movie-poster-thumbnail {
            width: 60px;
            height: 90px;
            object-fit: cover;
            border-radius: 4px;
        }
        .toggle-icon {
            transition: transform 0.3s;
        }
        .toggle-icon.active {
            transform: rotate(180deg);
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
            <div class="history-list">
                @foreach($orders as $order)
                    <div class="history-list-item {{ $order->status }}">
                        <div class="history-list-header d-flex justify-content-between align-items-center" onclick="toggleDetails({{ $order->id }})">
                            <div class="d-flex align-items-center">
                                <img src="{{ $order->movie_poster ?? asset('images/default-movie.jpg') }}" class="movie-poster-thumbnail me-3" alt="{{ $order->movie_title }}">
                                <div>
                                    <h5 class="mb-0">{{ $order->movie_title }}</h5>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ $order->screening_date }}
                                    </small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    @if($order->status == 'completed')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($order->status == 'pending')
                                        <span class="badge bg-warning">Menunggu Pembayaran</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @endif
                                </div>
                                <div class="toggle-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="history-list-content" id="details-{{ $order->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Detail Pesanan</h6>
                                    <p><strong>ID Pesanan:</strong> #{{ $order->id }}</p>
                                    <p><strong>Jumlah Tiket:</strong> {{ $order->ticket_count }}</p>
                                    <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    <p><strong>Tanggal Pemesanan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6>Detail Film</h6>
                                    <p><strong>Judul Film:</strong> {{ $order->movie_title }}</p>
                                    <p><strong>Tanggal Tayang:</strong> {{ $order->screening_date }}</p>
                                    <p><strong>Waktu Tayang:</strong> {{ $order->screening_time ?? 'Tidak tersedia' }}</p>
                                    <p><strong>Studio:</strong> {{ $order->studio ?? 'Tidak tersedia' }}</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-sm btn-outline-primary">Lihat Tiket</button>
                                @if($order->status == 'pending')
                                    <button class="btn btn-sm btn-outline-danger ms-2">Batalkan Pesanan</button>
                                @endif
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

        function toggleDetails(orderId) {
            const content = document.getElementById(`details-${orderId}`);
            const icon = content.previousElementSibling.querySelector('.toggle-icon i');
            
            if (content.classList.contains('active')) {
                content.classList.remove('active');
                icon.classList.remove('active');
            } else {
                content.classList.add('active');
                icon.classList.add('active');
            }
        }
    </script>
</body>
</html> 