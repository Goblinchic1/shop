<?php

namespace Tests\Feature\App\Http\Controllers;

use Database\Factories\ProductFactory;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\File;

class ThumbnailControllerTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_generated_success(): void
    {
        $size = '500x500';
        $method = 'resize';
        $storage = Storage::disk('images');

        config()->set('thumbnail', ['allowed_sizes' => [$size]]);

        $product = ProductFactory::new()->create();

        $response = $this->get($product->makeThumbnail($size, $method));

        $response->assertOk();

        $storage->exists(
            "products/$method/$size/" . File::basename($product->thumbnail)
        );
    }
}
