<?php

declare(strict_types=1);

namespace App\Http\Controllers\Url;

use App\Http\Controllers\Controller;
use App\Services\Url\UrlServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DetailUrlController extends Controller
{
    public function __construct(protected UrlServiceInterface $urlService) {}

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $url = $this->urlService->detailUrl($id);

        return response()->json($url);
    }
}
