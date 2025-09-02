@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0">
                    <h4 class="card-title mb-0">
                        <i class="bi bi-plus-circle me-2"></i>Create New Post
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                <i class="bi bi-type me-1"></i>Post Title
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required
                                   autofocus placeholder="Enter your post title">
                            @error('title')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">
                                <i class="bi bi-file-text me-1"></i>Post Content
                            </label>
                            <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="8" required
                                      placeholder="Write your post content here...">{{ old('body') }}</textarea>
                            @error('body')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                            <div class="form-text">
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Minimum 10 characters required. Title max 100 characters.
                                </small>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Create Post
                            </button>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
