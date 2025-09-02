<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserActionOccurred
{
    use Dispatchable, SerializesModels;

    /**
     * The authenticated user.
     */
    public User $user;

    /**
     * The description of the action.
     */
    public string $description;

    /**
     * The IP address from the request.
     */
    public ?string $ipAddress;

    /**
     * The user agent from the request.
     */
    public ?string $userAgent;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, string $description, ?string $ipAddress = null, ?string $userAgent = null)
    {
        $this->user = $user;
        $this->description = $description;
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
    }
}
