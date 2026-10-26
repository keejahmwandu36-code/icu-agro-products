<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_homepage_renders_with_the_shared_layout(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('<nav aria-label="Main navigation"', false);
        $response->assertSee('Quality Agricultural Products from Zambia');
    }
}
