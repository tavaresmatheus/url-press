<?php

declare(strict_types=1);

namespace App\Services\Url;

use App\Http\Resources\Url\UrlCollection;
use App\Http\Resources\Url\UrlResource;

interface UrlServiceInterface
{
    /**
     * @param  array{original_url: string, user_id: string}  $attributes
     */
    public function createUrl(array $attributes): UrlResource;

    public function detailUrl(string $id): UrlResource;

    public function listUrl(): UrlCollection;

    public function deleteUrl(string $id): bool;

    public function redirectFromSlugToUrl(string $slug): string;
}
