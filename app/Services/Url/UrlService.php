<?php

declare(strict_types=1);

namespace App\Services\Url;

use App\Exceptions\BusinessLogicException;
use App\Http\Resources\Url\UrlCollection;
use App\Http\Resources\Url\UrlResource;
use App\Models\Url;
use App\Repositories\Url\UrlRepositoryInterface;

class UrlService implements UrlServiceInterface
{
    public function __construct(protected UrlRepositoryInterface $urlRepository) {}

    /**
     * @param  array{original_url: string, user_id: string}  $attributes
     */
    public function createUrl(array $attributes): UrlResource
    {
        $attributes['slug'] = $this->generateSlugFromBase62(10);
        $attributes['accesses'] = 0;

        $url = new Url($attributes);

        return new UrlResource($this->urlRepository->create($url));
    }

    public function detailUrl(string $id): UrlResource
    {
        return new UrlResource($this->urlRepository->detail($id));
    }

    public function listUrl(): UrlCollection
    {
        $urls = $this->urlRepository->list();

        return new UrlCollection($urls);
    }

    public function deleteUrl(string $id): bool
    {
        $urlResource = $this->detailUrl($id);

        $urlModel = $urlResource->resource;

        $wasDeleted = $this->urlRepository->delete((string) $urlModel->id);
        if (! $wasDeleted) {
            throw new BusinessLogicException('Coudn\'t delete user.');
        }

        return $wasDeleted;
    }

    public function redirectFromSlugToUrl(string $slug): string
    {
        $url = $this->urlRepository->detailUrlBySlug($slug);

        $this->urlRepository->incrementAccesses((string) $url->id);

        return $url->original_url;
    }

    private function generateSlugFromBase62(int $length = 10): string
    {
        $base62 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength = strlen($base62);

        /** @phpstan-var int<1, max> $length */
        $bytes = random_bytes($length);

        $slug = '';
        for ($i = 0; $i < $length; $i++) {
            $slug .= $base62[ord($bytes[$i]) % $charsLength];
        }

        return $slug;
    }
}
