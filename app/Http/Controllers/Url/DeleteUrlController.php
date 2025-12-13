<?php

declare(strict_types=1);

namespace App\Http\Controllers\Url;

use App\Http\Controllers\Controller;
use App\Services\Url\UrlServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteUrlController extends Controller
{
    public function __construct(protected UrlServiceInterface $urlService) {}

    public function __invoke(Request $request, string $id): Response
    {
        $this->urlService->deleteUrl($id);

        return response()->noContent();
    }
}
