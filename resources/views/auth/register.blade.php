@extends('layouts.auth')

@section('title', 'Register')
@section('auth-title', 'Create your account')

@section('auth-content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">
                <i class="bi bi-person me-1"></i>Full Name
            </label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                   autofocus placeholder="Enter your full name">
            @error('name')
            <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">
                <i class="bi bi-envelope me-1"></i>Email Address
            </label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                   placeholder="Enter your email address">
            @error('email')
            <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">
                <i class="bi bi-lock me-1"></i>Password
            </label>
            <div class="input-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password"
                       placeholder="Create a strong password">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="bi bi-eye" id="toggleIcon"></i>
                </button>
            </div>
            @error('password')
            <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
            </div>
            @enderror
            <div class="form-text">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Password must be at least 8 characters with uppercase, lowercase, numbers, and symbols.
                </small>
            </div>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">
                <i class="bi bi-lock-fill me-1"></i>Confirm Password
            </label>
            <div class="input-group">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                       placeholder="Confirm your password">
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                    <i class="bi bi-eye" id="toggleIconConfirmation"></i>
                </button>
            </div>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-person-plus me-2"></i>Create Account
            </button>
        </div>
    </form>
@endsection

@section('auth-footer')
    <p class="text-muted">
        Already have an account?
        <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
            Sign in here
        </a>
    </p>
@endsection

@push('scripts')
    <script>
        // Toggle password visibility
        function togglePasswordVisibility(toggleId, inputId, iconId) {
            document.getElementById(toggleId).addEventListener('click', function () {
                const password = document.getElementById(inputId);
                const icon = document.getElementById(iconId);

                if (password.type === 'password') {
                    password.type = 'text';
                    icon.className = 'bi bi-eye-slash';
                } else {
                    password.type = 'password';
                    icon.className = 'bi bi-eye';
                }
            });
        }

        // Initialize password toggles
        togglePasswordVisibility('togglePassword', 'password', 'toggleIcon');
        togglePasswordVisibility('togglePasswordConfirmation', 'password_confirmation', 'toggleIconConfirmation');
    </script>
@endpush
