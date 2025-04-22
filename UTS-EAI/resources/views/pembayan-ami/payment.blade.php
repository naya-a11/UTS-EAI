<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Movie Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: #141414;
            color: white;
        }
        .payment-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 2rem;
            background: #1a1a1a;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }
        .movie-poster {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .payment-methods {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .payment-method {
            flex: 1;
            padding: 1rem;
            border: 2px solid #333;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #1f1f1f;
            color: white;
        }
        .payment-method:hover {
            border-color: #e50914;
            background-color: #2a2a2a;
        }
        .payment-method.active {
            border-color: #e50914;
            background-color: #2a2a2a;
        }
        .ticket-details {
            background-color: #1f1f1f;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            color: white;
        }
        .form-control {
            background-color: #1f1f1f;
            border: 1px solid #333;
            color: white;
        }
        .form-control:focus {
            background-color: #1f1f1f;
            border-color: #e50914;
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(229, 9, 20, 0.25);
        }
        .form-label {
            color: white;
        }
        .btn-primary {
            background-color: #e50914;
            border-color: #e50914;
        }
        .btn-primary:hover {
            background-color: #ff0f1f;
            border-color: #ff0f1f;
        }
        h2, h4, h5 {
            color: white;
        }
        .text-muted {
            color: #8c8c8c !important;
        }
        
        /* Modal Styles */
        .modal-content {
            background-color: #1a1a1a;
            color: white;
            border: 1px solid #333;
            border-radius: 15px;
        }
        
        .modal-header {
            border-bottom: 1px solid #333;
            padding: 1.5rem;
        }
        
        .modal-header .btn-close {
            color: white;
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        
        .modal-body {
            padding: 2rem;
            text-align: center;
        }
        
        .qris-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            margin: 1rem auto;
            max-width: 300px;
        }
        
        .qris-image {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        
        .payment-instructions {
            color: #999;
            margin: 1.5rem 0;
            font-size: 0.9rem;
            text-align: left;
        }
        
        .payment-instructions ol {
            padding-left: 1.5rem;
            margin-bottom: 0;
        }
        
        .payment-instructions li {
            margin-bottom: 0.5rem;
        }
        
        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 0.8rem 2rem;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-1px);
        }

        .modal-footer {
            border-top: 1px solid #333;
            padding: 1.5rem;
        }

        /* Success Notification Modal Styles */
        .success-notification-modal .modal-content {
            background-color: #1a1a1a;
            color: white;
            border: 1px solid #28a745;
            border-radius: 15px;
        }

        .success-notification-modal .modal-body {
            padding: 2rem;
            text-align: center;
        }

        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1.5rem;
            animation: scaleIn 0.5s ease-out;
        }

        .btn-ok {
            background-color: #28a745;
            color: white;
            padding: 0.8rem 3rem;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-ok:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
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
                        <a class="nav-link" href="{{ route('history.index') }}">
                            <i class="fas fa-history"></i> History
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container payment-container">
        <h2 class="mb-4">Payment</h2>
        
        <div class="row">
            <!-- Movie Details -->
            <div class="col-md-4">
                <img src="https://via.placeholder.com/300x450" alt="Movie Poster" class="movie-poster mb-3">
                <h4>Movie Title</h4>
                <p class="text-muted">Cinema: Cinema Name</p>
                <p class="text-muted">Date: DD/MM/YYYY</p>
                <p class="text-muted">Time: HH:MM</p>
            </div>

            <!-- Payment Details -->
            <div class="col-md-8">
                <div class="ticket-details">
                    <h5>Ticket Details</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Regular Ticket x {{ count($selectedSeats) }}</span>
                        <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Service Fee</span>
                        <span>Rp {{ number_format($serviceFee, 0, ',', '.') }}</span>
                    </div>
                    <hr style="border-color: #333;">
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>
                </div>

                <h5 class="mb-3">Payment Method</h5>
                <div class="payment-methods">
                    <div class="payment-method">
                        <i class="fas fa-wallet fa-2x mb-2"></i>
                        <p class="mb-0">E-Wallet</p>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-3">Pay Now</button>
            </div>
        </div>
    </div>

    <!-- QRIS Payment Modal -->
    <div class="modal fade" id="qrisModal" tabindex="-1" aria-labelledby="qrisModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrisModalLabel">Scan QRIS to Pay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="qris-container">
                        <img src="{{ asset('images/qris-code.png') }}" alt="QRIS Code" class="qris-image">
                    </div>
                    <div class="payment-instructions">
                        <h6 class="mb-3">Payment Instructions:</h6>
                        <ol>
                            <li>Open your preferred e-wallet application</li>
                            <li>Scan the QRIS code above</li>
                            <li>Check the payment details</li>
                            <li>Complete the payment</li>
                            <li>Click "I Have Paid" button below</li>
                        </ol>
                    </div>
                    <button type="button" class="btn btn-success btn-lg" onclick="handlePaymentComplete()">
                        <i class="fas fa-check-circle me-2"></i>I Have Paid
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Notification Modal -->
    <div class="modal fade success-notification-modal" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <i class="fas fa-check-circle success-icon"></i>
                    <h3 class="mb-4">Pembayaran Berhasil!</h3>
                    <p class="text-muted mb-4">Terima kasih atas pembelian Anda. Tiket akan dikirim melalui email.</p>
                    <button type="button" class="btn btn-ok" onclick="goToDashboard()">
                        OKE
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Payment method selection
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Add active class to first payment method by default
        document.querySelector('.payment-method').classList.add('active');

        // Handle Pay Now button click
        document.querySelector('.btn-primary').addEventListener('click', function(e) {
            e.preventDefault();
            const qrisModal = new bootstrap.Modal(document.getElementById('qrisModal'));
            qrisModal.show();
        });

        // Handle payment completion
        function handlePaymentComplete() {
            // Hide QRIS modal
            const qrisModal = bootstrap.Modal.getInstance(document.getElementById('qrisModal'));
            qrisModal.hide();
            
            // Show success notification
            setTimeout(() => {
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            }, 500);
        }

        // Handle going back to dashboard
        function goToDashboard() {
            window.location.href = "/";
        }

        function handleMoviesClick(event) {
            if (window.location.pathname === '/') {
                event.preventDefault();
                window.location.reload();
            }
        }
    </script>
</body>
</html> 