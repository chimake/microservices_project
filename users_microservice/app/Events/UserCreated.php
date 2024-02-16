<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $userData;

    /**
     * The name of the queue on which to place the job.
     *
     * @return string|null
     */
    public function queue()
    {
        return 'user_created'; 
    }

    /**
     * Create a new event instance.
     *
     * @param array $userData
     */
    public function __construct(array $userData)
    {
        $this->userData = $userData;
    }
}
