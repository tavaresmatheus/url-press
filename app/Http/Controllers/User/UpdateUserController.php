<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    public function __construct(protected UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  Request  $request
     * @param  string  $id
     * @return JsonResponse
     */
    public function __invoke(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'name' => 'max:255',
            'email' => 'email:rfc',
        ]);

        $attributes = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ];

        $user = $this->userService->updateUser($id, $attributes);

        return response()->json($user);
    }
}
