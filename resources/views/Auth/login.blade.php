<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 1rem;
        }
        .card-header {
            background-color: #13149f;
            color: #ffffff;
            font-size: 1.25rem;
            font-weight: bold;
            border-bottom: 0;
            border-radius: 1rem 1rem 0 0;
        }
        .card-body {
            padding: 2rem;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #13149f;
            border-color: #007bff;
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .invalid-feedback {
            display: block;
        }
        .alert {
            border-radius: 0.5rem;
        }
        .form-check-label {
            font-weight: normal;
        }
        .btn-forgot-password,
        .btn-back {
            background-color: #13149f;
            border-color: #007bff;
            color: #ffffff;
        }
        .btn-forgot-password:hover,
        .btn-back:hover {
            background-color: #0056b3;
            border-color: #004085;
            color: #ffffff; /* Ensure text color remains white on hover */
        }
        .d-flex {
            display: flex;
            justify-content: start;
        }
        .ml-2 {
            margin-left: 0.5rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card mt-5">
                <div class="card-header">Login</div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('loginForm') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" id="remember" class="form-check-input" name="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                    <div class="mt-3 d-flex">
                        <a href="{{ route('register') }}" class="btn btn-back">Back</a>
                        <a href="{{ route('forgotPasswordForm') }}" class="btn btn-forgot-password ml-2">Forgot Your Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
