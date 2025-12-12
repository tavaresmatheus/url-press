<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListUsersController extends Controller
{
    public function __construct(protected UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $users = $this->userService->listUsers();

        return response()->json($users);
    }
}
