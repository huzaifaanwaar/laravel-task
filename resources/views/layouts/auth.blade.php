<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<body>
<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card p-4">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">
                            <i class="bi bi-shield-check me-2"></i>{{ config('app.name', 'Laravel') }}
                        </h2>
                        <p class="text-muted">@yield('auth-title', 'Welcome')</p>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @yield('auth-content')
                    <div class="text-center mt-4">
                        @yield('auth-footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.scripts')
</body>
</html>
