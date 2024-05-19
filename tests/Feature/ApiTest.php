<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Subscription;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function testGetRate()
    {
        $response = $this->getJson('/api/rate');

        $response->assertStatus(200);
        $response->assertJsonStructure(['rate']);
    }

    public function testSubscribeEmail()
    {
        $response = $this->postJson('/api/subscribe', ['email' => 'test@example.com']);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'E-mail added']);
        $this->assertDatabaseHas('subscriptions', ['email' => 'test@example.com']);
    }

    public function testSubscribeDuplicateEmail()
    {
        Subscription::create(['email' => 'test@example.com']);

        $response = $this->postJson('/api/subscribe', ['email' => 'test@example.com']);

        $response->assertStatus(409);
        $response->assertJson(['error' => 'The email has already been taken.']);
    }
}
