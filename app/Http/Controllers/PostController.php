<?php

namespace App\Http\Controllers;

use App\Events\UserActionOccurred;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        event(new UserActionOccurred(
            Auth::user(),
            'User created a new post: "' . $post->title . '"',
            $request->ip(),
            $request->userAgent()
        ));

        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }
}
