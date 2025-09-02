@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </h1>
            <div class="text-muted">
                <i class="bi bi-calendar me-1"></i>{{ now()->format('F j, Y') }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="card-title mb-2">
                            Welcome back, {{ Auth::user()->name }}!
                            <i class="bi bi-emoji-smile text-warning"></i>
                        </h2>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-person-check text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-circle me-2"></i>Account Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <strong>Name:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ Auth::user()->name }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ Auth::user()->email }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
                        <strong>Member Since:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ Auth::user()->created_at->format('M j, Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
