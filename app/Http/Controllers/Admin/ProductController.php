<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ProductController extends Controller
{
    /**
     * Create product for category
     *
     * @param Category $category
     * @return View|Application|Factory
     */
    public function create(Category $category): View|Application|Factory
    {
        return view('products.create', compact('category'));
    }

    public function store(Category $category, ProductRequest $request)
    {

    }
}
