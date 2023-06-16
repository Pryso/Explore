<?php

namespace App\Http\Resources;

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
            'price' => $this->price,
            'short_desc' => $this->short_desc,
            'desc' => $this->desc,
            'category'=> [
                'id' => $this->category->id,
                'place' => $this->category->place,
                'type' => $this->category->type,
            ],
            'seller' => [
                'id'=> $this->seller->id,
                'name'=> $this->seller->name,
                'avg_rate'=>$this->seller->avg_rate,
            ]
        ];
    }
}
