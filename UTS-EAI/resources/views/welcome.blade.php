<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Login - EAI Service</title>
    <!-- Bootstrap CSS -->
=======
    <title>Welcome to Movie Booking</title>
>>>>>>> main
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .welcome-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
<<<<<<< HEAD
        }
        .form-control {
            border-radius: 8px;
            padding: 0.75rem;
            margin-bottom: 1rem;
        }
        .btn-login {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
=======
            text-align: center;
>>>>>>> main
        }
        .title {
            margin-bottom: 2rem;
            color: #333;
        }
        .alert {
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .role-selection {
            margin-top: 2rem;
            text-align: center;
        }
        .role-text {
            color: #666;
            margin-bottom: 1rem;
        }
        .role-link {
            color: #4CAF50;
            text-decoration: none;
            font-weight: 500;
        }
        .role-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<<<<<<< HEAD
    <div class="login-container">
        <h2 class="title">Welcome to EAI Service</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('customer.login.submit') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-login">Login</button>
        </form>

        <div class="role-selection">
            <p class="role-text">Are you an admin? <a href="{{ route('admin.login') }}" class="role-link">Login here</a></p>
=======
    <div class="welcome-container">
        <h2 class="title">Welcome to Movie Booking</h2>
        <div class="d-grid gap-2">
            <a href="{{ route('movies.index') }}" class="btn btn-primary">
                <i class="fas fa-film"></i> Browse Movies
            </a>
>>>>>>> main
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
