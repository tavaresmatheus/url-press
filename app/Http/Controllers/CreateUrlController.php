<?php

namespace App\Http\Controllers;

use App\Services\Url\UrlServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateUrlController extends Controller
{
    public function __construct(protected UrlServiceInterface $urlService)
    {
        $this->urlService = $urlService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate(['originalUrl' => 'required|URL',]);

        $user = $request->user();
        $attributes = [
            'original_url' => $request->get('originalUrl'),
            'user_id' => $user->id,
        ];
        $url = $this->urlService->createUrl($attributes);

        $urlId = '';
        if (is_string($url['id'])) {
            $urlId = $url['id'];
        }

        return response()->json($url, 201)->header('Location', url('api/urls/'.$urlId));
    }
}
