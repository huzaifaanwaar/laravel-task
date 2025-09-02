<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class StoreLoginActivity implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    protected function recentlyLogged(array $attrs): bool
    {
        return ActivityLog::query()
            ->where('user_id', $attrs['user_id'])
            ->where('description', $attrs['description'])
            ->where('ip_address', $attrs['ip_address'])
            ->where('user_agent', $attrs['user_agent'])
            ->where('created_at', '>=', now()->subSeconds(10))
            ->exists();
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        if (($event->guard ?? null) !== 'web') {
            return;
        }

        $request = app(Request::class);
        $payload = [
            'user_id' => $event->user->id,
            'description' => 'User logged in successfully',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ];

        if ($this->recentlyLogged($payload)) {
            return;
        }

        ActivityLog::create($payload);
    }

    /**
     * Handle a job failure.
     */
    public function failed(Login $event, \Throwable $exception): void
    {
        \Log::error('Failed to store login activity', [
            'user_id' => $event->user->id,
            'guard' => $event->guard ?? null,
            'error' => $exception->getMessage(),
        ]);
    }
}
