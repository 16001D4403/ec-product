<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PreventRequestsDuringMaintenanceTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function test_it_blocks_requests_when_in_maintenance_mode()
    {
        // Simulate putting the app in maintenance mode
        $this->artisan('down');

        $response = $this->get('/'); // Assuming this route uses the middleware

        $response->assertStatus(503); // Expect a 503 Service Unavailable response
    }

    /** @test */
    public function test_it_allows_requests_to_excepted_uris_in_maintenance_mode()
    {
        // Add an excepted URI in your middleware, then test accessing it
        // ...

        $response = $this->get('/excepted-uri');

        $response->assertStatus(200); // or the expected success status
    }

    /** @test */
    public function test_it_allows_requests_when_not_in_maintenance_mode()
    {
        $response = $this->get('/'); // Assuming this route uses the middleware

        $response->assertStatus(200); // Expect a successful response
    }
}
