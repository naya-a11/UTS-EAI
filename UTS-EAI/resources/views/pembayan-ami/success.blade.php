<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - Moononton</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: #141414;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .success-container {
            max-width: 600px;
            margin: 4rem auto;
            padding: 3rem;
            background: #1a1a1a;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0,0,0,0.3);
            text-align: center;
        }
        .success-icon {
            font-size: 5rem;
            color: #28a745;
            margin-bottom: 2rem;
            animation: scaleIn 0.5s ease-out;
        }
        .order-number {
            background: #242424;
            padding: 1rem;
            border-radius: 8px;
            margin: 2rem 0;
            font-family: monospace;
            font-size: 1.2rem;
            letter-spacing: 2px;
        }
        .btn-home {
            background-color: #e50914;
            color: white;
            padding: 0.8rem 2.5rem;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
        }
        .btn-home:hover {
            background-color: #ff0f1f;
            color: white;
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
    <!-- Navbar -->
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

    <!-- Success Content -->
    <div class="container success-container">
        <i class="fas fa-check-circle success-icon"></i>
        <h1 class="mb-4">{{ $message }}</h1>
        <p class="text-muted mb-4">Thank you for your purchase! Your order has been successfully processed.</p>
        <div class="order-number">
            Order Number: {{ $orderNumber }}
        </div>
        <p class="text-muted mb-4">You will receive a confirmation email shortly with your ticket details.</p>
        <a href="/" class="btn-home">
            <i class="fas fa-home me-2"></i>Back to Home
        </a>
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