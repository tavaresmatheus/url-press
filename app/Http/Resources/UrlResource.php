<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \App\Models\Url $resource
 */
class UrlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'originalUrl' => $this->resource->original_url,
            'slug' => $this->resource->slug,
            'accesses' => $this->resource->accesses,
            'createdAt' => $this->resource->created_at->format('Y-m-d\TH:i:s'),
            'updatedAt' => $this->resource->updated_at?->format('Y-m-d\TH:i:s'),
        ];
    }
}
