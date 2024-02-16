<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerFunctionalTest extends TestCase
{
    public function testStoreMethodCreatesUserAndReturnsSuccessResponse()
    {
        $response = $this->postJson('/api/users', [
            'email' => 'test@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe'
        ]);

        $response
            ->assertStatus(201)
            ->assertJson(['message' => 'User data logged successfully']);
    }
}
