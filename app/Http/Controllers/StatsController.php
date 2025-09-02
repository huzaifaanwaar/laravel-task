<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->loadCount(['posts', 'activityLogs']);
        $recentPosts = $user->posts()->latest()->take(5)->get();

        return view('stats', compact('user', 'recentPosts'));
    }
}
