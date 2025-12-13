<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteMeController extends Controller
{
    public function __construct(protected UserServiceInterface $userService) {}

    public function __invoke(Request $request): Response
    {
        /** @var User $user */
        $user = $request->user();

        $this->userService->deleteUser($user->id);

        return response()->noContent();
    }
}
