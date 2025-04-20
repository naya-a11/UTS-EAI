<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Role Selection</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        .role-btn {
            width: 100%;
            padding: 1rem;
            margin: 0.5rem 0;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .role-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .customer-btn {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
        }
        .provider-btn {
            background: linear-gradient(45deg, #2196F3, #1976D2);
            color: white;
        }
        .title {
            color: #333;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="title">Select Your Role</h2>
        <div class="d-grid gap-2">
            <a href="{{ route('customer.login') }}" class="role-btn customer-btn text-decoration-none">
                <i class="fas fa-user"></i> Customer
            </a>
            <a href="{{ route('provider.login') }}" class="role-btn provider-btn text-decoration-none">
                <i class="fas fa-user-shield"></i> Admin
            </a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
