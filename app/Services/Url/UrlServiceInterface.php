<?php

declare(strict_types=1);

namespace App\Services\Url;

use App\Http\Resources\Url\UrlCollection;
use App\Http\Resources\Url\UrlResource;

interface UrlServiceInterface
{
    /**
     * @param  array{original_url: string, user_id: string}  $attributes
     * @return UrlResource
     */
    public function createUrl(array $attributes): UrlResource;

    /**
     * @param  string  $id
     * @return UrlResource
     */
    public function detailUrl(string $id): UrlResource;

    /**
     * @return UrlCollection
     */
    public function listUrl(): UrlCollection;

    /**
     * @param  string  $id
     * @return bool
     */
    public function deleteUrl(string $id): bool;
}
