<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'delete' => $this->delete,
            'image' => $this->image,
            'price' => $this->price,
            'discount' => $this->discount,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ]
            // 'category' => $this->category ? [
            //     'id' => $this->category->id,
            //     'name' => $this->category->name,
            // ] : null,
        ];
    }
}
