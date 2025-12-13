<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteUserController extends Controller
{
    public function __construct(protected UserServiceInterface $userService) {}

    public function __invoke(Request $request, string $id): Response
    {
        $this->userService->deleteUser($id);

        return response()->noContent();
    }
}
