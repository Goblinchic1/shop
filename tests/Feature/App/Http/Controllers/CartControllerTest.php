<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\CartController;
use Database\Factories\ProductFactory;
use Domain\Cart\CartManager;
use Domain\Cart\Facades\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        CartManager::fake();
    }


    /**
     * @test
     * @return void
     */
    public function it_is_empty_cart(): void
    {
        $this->get(action([CartController::class, 'index']))
            ->assertOk()
            ->assertViewIs('cart.index')
            ->assertViewHas('items', collect([]));
    }


    /**
     * @test
     * @return void
     */
    public function it_not_empty_cart(): void
    {
        $product = ProductFactory::new()->create();

        Cart::add($product);

        $this->get(action([CartController::class, 'index']))
            ->assertOk()
            ->assertViewIs('cart.index')
            ->assertViewHas('items', cart()->items());
    }


    /**
     * @test
     * @return void
     */
    public function it_added_success(): void
    {
        $product = ProductFactory::new()->create();

        $this->assertEquals(0, Cart::count());

        $this->post(
            action([CartController::class, 'add'], $product),
            ['quantity' => 4]
        )
            ->assertRedirect();

        $this->assertEquals(4, Cart::count());
    }


    /**
     * @test
     * @return void
     */
    public function it_quantity_changed(): void
    {
        $product = ProductFactory::new()->create();

        Cart::add($product, 4);

        $this->assertEquals(4, Cart::count());

        $this->post(
            action([CartController::class, 'quantity'], Cart::items()->first()),
            ['quantity' => 8]
        )
            ->assertRedirect();

        $this->assertEquals(8, Cart::count());
    }


    /**
     * @test
     * @return void
     */
    public function it_delete_success(): void
    {
        $product = ProductFactory::new()->create();

        Cart::add($product, 4);

        $this->assertEquals(4, Cart::count());

        $this->delete(
            action([CartController::class, 'delete'], Cart::items()->first())
        )
            ->assertRedirect();

        $this->assertEquals(0, Cart::count());
    }


    /**
     * @test
     * @return void
     */
    public function it_truncate_success(): void
    {
        $product = ProductFactory::new()->create();

        Cart::add($product, 4);

        $this->assertEquals(4, Cart::count());

        $this->delete(
            action([CartController::class, 'truncate'])
        )
            ->assertRedirect();

        $this->assertEquals(0, Cart::count());
    }
}
