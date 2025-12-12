<?php

namespace App\Http\Controllers;

use App\Models\User;
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
     * @param  Request  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function __invoke(Request $request, User $user): JsonResponse
    {
        $request->validate(['originalUrl' => 'required|URL']);

        /** @var string $originalUrl */
        $originalUrl = $request->get('originalUrl');

        $attributes = [
            'original_url' => $originalUrl,
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
