<?php

declare(strict_types=1);

namespace App\Services\Url;

use App\Http\Resources\UrlResource;

interface UrlServiceInterface
{
    /**
     * @param array<original_url: string, user_id: string> $attributes
     * @return Urlresource
     */
    public function createUrl(array $attributes): UrlResource;
}
