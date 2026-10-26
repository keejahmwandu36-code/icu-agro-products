<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ShopPageTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_shop_page_displays_the_products_banner_and_empty_state(): void
    {
        $response = $this->get(route('shop'));

        $response->assertOk();
        $response->assertSeeInOrder(['images/slides/products-hero.jpg', '<main class="flex-1">'], false);
        $response->assertSee('Browse All Products');
        $response->assertSee('No products found');
    }
}
