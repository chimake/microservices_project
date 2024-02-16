<?php

namespace Tests\Unit;

use App\Events\UserCreated;
use App\Listeners\UserCreatedListener;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\TestCase;

class UserCreatedListenerTest extends TestCase
{
    public function testHandleMethodLogsUserData()
    {
        Log::shouldReceive('channel')->with('notification')->once()->andReturnSelf();
        Log::shouldReceive('info')->with('UserCreated event received:', ['email' => 'test@example.com', 'firstName' => 'John', 'lastName' => 'Doe'])->once();

        $event = new UserCreated([
            'email' => 'test@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe'
        ]);

        $listener = new UserCreatedListener();
        $listener->handle($event);
    }

}
