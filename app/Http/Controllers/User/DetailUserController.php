<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DetailUserController extends Controller
{
    public function __construct(protected UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $user = $this->userService->detailUser($id);

        return response()->json($user);
    }
}
