<?php

declare(strict_types=1);

namespace App\Http\Controllers\Url;

use App\Http\Controllers\Controller;
use App\Services\Url\UrlServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListUrlsController extends Controller
{
    public function __construct(protected UrlServiceInterface $urlService) {}

    public function __invoke(Request $request): JsonResponse
    {
        $urls = $this->urlService->listUrl();

        return response()->json($urls);
    }
}
