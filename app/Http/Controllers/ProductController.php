<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function __invoke(Product $product): Factory|View|Application
    {
        $product->load(['optionValues.option']);

        if (session()->has('also')) {
            $alsoProductsIds = session()->get('also');
            $alsoProductsIds[$product->id] = $product->id;
            $alsoProducts = Product::query()
                ->whereIn('id', session()->get('also'))
                ->limit(4)
                ->get();
            session()->put('also', $alsoProductsIds);
        } else {
            session()->put('also.', $product->id, $product->id);
        }


        return view('product.show', [
            'product' => $product,
            'options' => $product->optionValues->keyValues(),
            'alsoProducts' => $alsoProducts ?? null
        ]);
    }
}
