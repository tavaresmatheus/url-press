<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DetailMeController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $me = new UserResource($request->user());

        return response()->json($me);
    }
}
