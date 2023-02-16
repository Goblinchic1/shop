<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Category;
use Domain\Catalog\ViewModels\BrandViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
   public function __invoke(): Factory|View|Application
   {
       $categories = CategoryViewModel::make()
           ->homePage();

       $brands = BrandViewModel::make()
           ->homePage();

       $products = Product::query()
           ->homePage()
           ->get();

       return view('index', compact(
           'products',
           'brands',
           'categories'
       ));
   }
}
