@extends('layouts.app')

@section('content')

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #fef9f4;
            color: #3e2f21;
        }

        .navbar {
            background-color: #5c3d2e;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .navbar a {
            color: white !important;
            font-weight: 600;
        }
        .nav-link{
            color: white !important;
            font-weight: 600;
        }
        .navbar-brand{
            color: white !important;
            font-weight: 700;
            font-size: 28px;
            text-transform: uppercase !important;
        }

        .navbar a:hover {
            color:rgb(205, 208, 208) !important;
        }
        .footer {
            background-color: #3e2f21;
            color: #fff;
            padding: 20px 0;
        }
        .footer a {
            color: #fff;
            margin: 0 10px;
        }
        .navbar-toggler{
            background-color: white;
        }
        .dropdown-toggle{
            text-transform: uppercase !important;
        }
        .dropdown-item{
            color: white;
            font-weight:bold;
        }
        .dropdown-item:hover{
            color:rgb(205, 208, 208) !important;
            font-weight:bold;
        }
        .dropdown-menu{
            background-color:#5c3d2e;
        }
        .h3, h3{
            color: black;
            font-size: 1.5rem;
            font-weight: 700;
        }
        .registration-container {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fef9f4;
        }
        .registration-card {
            max-width: 500px;
            width: 100%;
            background-color: white;
            border: 1px solid #dac4a2;
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(92, 61, 46, 0.1);
        }
        .form-label {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: black !important;
        }
        .form-control {
            font-size: 14px;
            border: 1px solid #dac4a2;
            border-radius: 5px !important;
            padding: 0.4rem 1rem;
            transition: all 0.3s ease;
            background-color: transparent;
            color: black;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(92, 61, 46, 0.15);
            border-color: #5c3d2e;
        }
        .btn-accent {
            background-color: #5c3d2e;
            color: white;
            border: none;
        }
        .btn-accent:hover {
            background-color: #3e2f21;
            color: white;
        }
        .text-decoration-none{
            color: black;
            font-size: 16px;
        }
    </style>

<div class="registration-container">
    <div class="registration-card shadow-sm p-4">
        <h3 class="text-center mb-4">Create Your Recipe Account 🍰</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control rounded-pill @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control rounded-pill @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control rounded-pill @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-pill @error('password_confirmation') is-invalid @enderror" required>
                @error('password_confirmation')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-accent rounded-[600]">Register</button>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-decoration-none" style="color: #5c3d2e;">Already registered? Log in</a>
            </div>
        </form>
    </div>
</div>
@endsection
