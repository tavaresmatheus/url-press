<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Url\UrlServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DetailUrlController extends Controller
{
    public function __construct(protected UrlServiceInterface $urlService)
    {
        $this->urlService = $this->urlService;
    }

    /**
     * @param  Request  $request
     * @param  string  $id
     * @return JsonResponse
     */
    public function __invoke(Request $request, string $id): JsonResponse
    {
        $url = $this->urlService->detailUrl($id);

        return response()->json($url);
    }
}
