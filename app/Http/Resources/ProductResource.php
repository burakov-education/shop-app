<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $imageUrls = $this->images;
        $defaultImage = null;

        if (isset($imageUrls[0])) {
            $defaultImage = array_shift($imageUrls);
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image_urls' => $imageUrls,
            'default_image' => $defaultImage,
        ];
    }
}
