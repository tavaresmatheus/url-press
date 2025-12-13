<?php

namespace App\Http\Controllers\Url;

use App\Http\Controllers\Controller;
use App\Services\Url\UrlServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectToUrlController extends Controller
{
    public function __construct(protected UrlServiceInterface $urlService) {}

    public function __invoke(Request $request, string $slug): RedirectResponse
    {
        $originalUrl = $this->urlService->redirectFromSlugToUrl($slug);

        return redirect()->away($originalUrl);
    }
}
