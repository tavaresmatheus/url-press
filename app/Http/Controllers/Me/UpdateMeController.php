<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateMeController extends Controller
{
    public function __construct(protected UserServiceInterface $userService) {}

    public function __invoke(Request $request): JsonResponse {
        $request->validate([
            'name' => 'max:255',
            'email' => 'email:rfc',
        ]);

        $attributes = request()->only(['name', 'email']);

        $user = $this->userService->updateUser($request->user()->id, $attributes);

        return response()->json($user);
    }
}
