<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * Get categories
     *
     * @return array
     */
    public function categories(): array
    {
        return [
            'data' => Category::all(),
        ];
    }

    /**
     * Get products from category
     *
     * @param Category $category
     * @return AnonymousResourceCollection
     */
    public function index(Category $category): AnonymousResourceCollection
    {
        return ProductResource::collection($category->products);
    }

    /**
     * Show product
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }
}
