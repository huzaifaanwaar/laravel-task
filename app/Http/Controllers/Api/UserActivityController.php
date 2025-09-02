<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $activityLogs = $user->activityLogs()
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $activityLogs->items(),
            'pagination' => [
                'current_page' => $activityLogs->currentPage(),
                'last_page' => $activityLogs->lastPage(),
                'per_page' => $activityLogs->perPage(),
                'total' => $activityLogs->total(),
                'from' => $activityLogs->firstItem(),
                'to' => $activityLogs->lastItem(),
            ],
            'meta' => [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'total_activities' => $user->activityLogs()->count(),
            ]
        ]);
    }
}
