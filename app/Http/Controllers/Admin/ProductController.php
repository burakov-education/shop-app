<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;

class ProductController extends Controller
{
    /**
     * Show products
     *
     * @return View|Application|Factory
     */
    public function index(): View|Application|Factory
    {
        return view('products.index', [
            'products' => Product::query()->paginate(5),
        ]);
    }

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

    /**
     * Show product
     *
     * @param Product $product
     * @return View|Application|Factory
     */
    public function show(Product $product): View|Application|Factory
    {
        return view('products.show', compact('product'));
    }

    /**
     * Create product
     *
     * @param Category $category
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(Category $category, ProductRequest $request): RedirectResponse
    {
        /** @var Product $product */
        $product = $category->products()->create($request->validated());

        $this->updateImages($product, $request->file('images'));

        return redirect()->route('categories.show', $category);
    }

    /**
     * Update product form
     *
     * @param Product $product
     * @return View|Application|Factory
     */
    public function edit(Product $product): View|Application|Factory
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update product
     *
     * @param Product $product
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function update(Product $product, ProductRequest $request): RedirectResponse
    {
        $product->update($request->validated());
        $this->updateImages($product, $request->file('images'));

        return redirect()->route('categories.show', $product->category);
    }

    /**
     * Delete product
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function delete(Product $product): RedirectResponse
    {
        foreach ($product->images as $image) {
            @unlink(public_path($image));
        }

        $product->delete();

        return redirect()->route('categories.show', $product->category);
    }

    /**
     * Set images for product
     *
     * @param Product $product
     * @param UploadedFile[]|mixed $files
     * @return void
     */
    private function updateImages(Product $product, mixed $files): void
    {
        if ($files) {
            $images = [];

            foreach ($files as $image) {
                $imageName = uniqid() . '-' . $image->getClientOriginalName();

                $outputPath = public_path('images') . '/' . $imageName;

                if (file_exists($image->getRealPath())) {
                    $this->createThumbnailWithWatermark($image->getRealPath(), $outputPath);
                    $images []= 'images/' . $imageName;
                }
            }

            $product->images = $images;
            $product->save();
        }
    }

    /**
     * Create watermark
     *
     * @param $sourcePath
     * @param $outputPath
     * @return void
     */
    private function createThumbnailWithWatermark($sourcePath, $outputPath): void
    {
        [$origWidth, $origHeight, $imageType] = getimagesize($sourcePath);

        $srcImage = match ($imageType) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($sourcePath),
            IMAGETYPE_PNG => imagecreatefrompng($sourcePath),
        };

        $maxWidth = 300;
        $maxHeight = 450;

        if ($origWidth > $origHeight) {
            $newWidth = $maxWidth;
            $newHeight = $origHeight * $newWidth / $origWidth;
        } else {
            $newHeight = $maxHeight;
            $newWidth = $origWidth * $newHeight / $origHeight;
        }

        if ($newWidth > $maxWidth) {
            $newHeight = $newHeight * $maxWidth / $newWidth;
            $newWidth = $maxWidth;
        }

        if ($newHeight > $maxHeight) {
            $newWidth = $newHeight * $maxHeight / $newHeight;
            $newHeight = $maxHeight;
        }

        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresized($newImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

        $text = "Shop";
        $fontSize = 10;
        $fontColor = imagecolorallocate($newImage, 100, 100, 100);
        imagestring($newImage, $fontSize, $newWidth - 40, $newHeight - 15, $text, $fontColor);

        imagejpeg($newImage, $outputPath, 90);

        imagedestroy($newImage);
        imagedestroy($srcImage);
    }
}
