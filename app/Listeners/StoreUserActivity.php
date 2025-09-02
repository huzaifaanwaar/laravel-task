<?php

namespace App\Listeners;

use App\Events\UserActionOccurred;
use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreUserActivity implements ShouldQueue
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
    public function handle(UserActionOccurred $event): void
    {
        $payload = [
            'user_id' => $event->user->id,
            'description' => $event->description,
            'ip_address' => $event->ipAddress,
            'user_agent' => $event->userAgent,
        ];
        if ($this->recentlyLogged($payload)) {
            return;
        }

        ActivityLog::create($payload);
    }

    /**
     * Handle a job failure.
     */
    public function failed(UserActionOccurred $event, \Throwable $exception): void
    {
        \Log::error('Failed to store user activity', [
            'user_id' => $event->user->id,
            'description' => $event->description,
            'error' => $exception->getMessage(),
        ]);
    }
}
