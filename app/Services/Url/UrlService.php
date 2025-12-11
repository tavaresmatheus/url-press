<?php

declare(strict_types=1);

namespace App\Services\Url;

use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Repositories\Url\UrlRepositoryInterface;

class UrlService implements UrlServiceInterface
{
    public function __construct(protected UrlRepositoryInterface $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    /**
     * @param array<original_url: string, user_id: string> $attributes
     * @return UrlResource
     */
    public function createUrl(array $attributes): UrlResource
    {
        $attributes['slug'] = $this->generateSlugFromBase62(10);
        $attributes['accesses'] = 0;

        $url = new Url($attributes);

        return new UrlResource($this->urlRepository->create($url));
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateSlugFromBase62(int $length = 10): string
    {
        $base62 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength = strlen($base62);

        $bytes = random_bytes($length);

        $slug = '';
        for ($i = 0; $i < $length; $i++) {
            $slug .= $base62[ord($bytes[$i]) % $charsLength];
        }

        return $slug;
    }
}
