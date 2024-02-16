<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    /**
     * Store a newly created user and log the data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validate the request data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
        ]);

        // Log the user data
        Log::channel('users')->info('New user created', $validatedData);

        Log::channel('users')->info('Before dispatching UserCreated event.');
        // Dispatch the UserCreated event
        Event::dispatch(new UserCreated($validatedData));

        Log::channel('users')->info('After dispatching UserCreated event.');

        // Return a success response
        return response()->json(['message' => 'User data logged successfully'], 201);
    }
}
