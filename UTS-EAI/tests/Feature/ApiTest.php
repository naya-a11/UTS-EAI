<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * Test if the API is accessible
     *
     * @return void
     */
    public function test_api_is_accessible()
    {
        $response = $this->get('/api/test');

        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'API is working!',
                    'status' => 'success'
                ]);
    }
} 