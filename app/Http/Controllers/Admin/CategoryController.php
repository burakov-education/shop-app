<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * List categories
     *
     * @return View|Application|Factory
     */
    public function index(): View|Application|Factory
    {
        return view('categories.index', [
            'categories' => Category::query()->orderBy('id', 'DESC')->get(),
        ]);
    }

    /**
     * Show category
     *
     * @param Category $category
     * @return View|Application|Factory
     */
    public function show(Category $category): View|Application|Factory
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Create category form
     *
     * @return View|Application|Factory
     */
    public function create(): View|Application|Factory
    {
        return view('categories.create');
    }

    /**
     * Create category
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::query()->create($request->validated());

        return redirect()->route('categories.index');
    }

    /**
     * Edit category form
     *
     * @param Category $category
     * @return View|Application|Factory
     */
    public function edit(Category $category): View|Application|Factory
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Edit category
     *
     * @param Category $category
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function update(Category $category, CategoryRequest $request): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('categories.index');
    }

    /**
     * Delete category
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function delete(Category $category): RedirectResponse
    {
        if ($category->products()->count() === 0) {
            $category->delete();
        }

        return redirect()->back();
    }
}
