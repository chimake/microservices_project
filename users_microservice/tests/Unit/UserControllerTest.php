<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use App\Events\UserCreated;

class UserControllerTest extends TestCase
{
    public function testStoreMethodLogsUserData()
    {
        Event::fake();

        // Expect logging of user data
        Log::shouldReceive('channel')->with('users')->once()->andReturnSelf();

        Log::shouldReceive('info')->with('New user created', ['email' => 'test@example.com', 'firstName' => 'John', 'lastName' => 'Doe'])->once();

        // Expect logging before and after event dispatching
        Log::shouldReceive('channel')->with('users')->times(2)->andReturnSelf();

        Log::shouldReceive('info')->with('Before dispatching UserCreated event.')->once();

        Log::shouldReceive('info')->with('After dispatching UserCreated event.')->once();

        $request = new Request([
            'email' => 'test@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe'
        ]);

        $controller = new UserController();
        $response = $controller->store($request);

        $this->assertEquals(201, $response->status()); // Check status code directly
    }

}
