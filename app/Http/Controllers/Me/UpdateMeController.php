<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateMeController extends Controller
{
    public function __construct(protected UserServiceInterface $userService) {}

    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'max:255',
            'email' => 'email:rfc',
        ]);

        /** @var array<string, mixed> */
        $attributes = request()->only(['name', 'email']);

        /** @var User $user */
        $user = $request->user();
        $updatedUser = $this->userService->updateUser($user->id, $attributes);

        return response()->json($updatedUser);
    }
}
