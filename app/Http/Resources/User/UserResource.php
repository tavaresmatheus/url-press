<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \App\Models\User $resource
 */
class UserResource extends JsonResource
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
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'emailVerifiedAt' => $this->resource->email_verified_at,
            'createdAt' => $this->resource->created_at->format('Y-m-d\TH:i:s'),
            'updatedAt' => $this->resource->updated_at?->format('Y-m-d\TH:i:s'),
        ];
    }
}
