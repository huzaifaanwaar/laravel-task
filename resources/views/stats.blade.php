@extends('layouts.app')

@section('title', 'Statistics')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="bi bi-graph-up me-2"></i>Statistics
                </h1>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-circle me-2"></i>User Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="p-3">
                                <i class="bi bi-file-text text-primary" style="font-size: 2rem;"></i>
                                <h4 class="mt-2 mb-0">{{ $user->posts_count }}</h4>
                                <small class="text-muted">Total Posts</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3">
                                <i class="bi bi-clock-history text-success" style="font-size: 2rem;"></i>
                                <h4 class="mt-2 mb-0">{{ $user->activity_logs_count }}</h4>
                                <small class="text-muted">Activity Logs</small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Member Since:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $user->created_at->format('F j, Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-file-text me-2"></i>Recent Posts
                    </h5>
                </div>
                <div class="card-body">
                    @if($recentPosts->isNotEmpty())
                        <div class="list-group list-group-flush">
                            @foreach($recentPosts as $post)
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $post->title }}</h6>
                                            <p class="mb-1 text-muted">{{ Str::limit($post->body, 100) }}</p>
                                            <small class="text-muted">
                                                <i class="bi bi-clock me-1"></i>{{ $post->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-file-text text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">No posts created yet.</p>
                            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle me-1"></i>Create Your First Post
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
