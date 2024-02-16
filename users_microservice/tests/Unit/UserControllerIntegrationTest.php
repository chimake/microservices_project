<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redis;
use App\Events\UserCreated;
class UserControllerIntegrationTest extends TestCase
{

    public function testStoreMethodDispatchesUserCreatedEvent()
    {
        Event::fake();

        $userData = [
            'email' => 'test@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe'
        ];

        // Expect Redis publish method to be called with event name and data
        Redis::shouldReceive('publish')->with('UserCreated', json_encode([
            'event' => 'App\Events\UserCreated',
            'data' => $userData
        ]))->once();

        // Call the controller action
        $this->postJson('/api/users', $userData)
            ->assertStatus(201);

        // Assert that the UserCreated event was dispatched
        Event::assertDispatched(UserCreated::class);
    }


}
