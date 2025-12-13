<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    public function __construct(protected UserServiceInterface $userService) {}

    public function __invoke(Request $request): JsonResponse
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email:rfc',
                'password' => [
                    'required',
                    'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])(?=.*\W).{11,30}$/',
                ],
            ],
            [
                'password.regex' => 'Your password must have a number, a lowercase letter, a uppercase letter, a special character and length between 11 to 30 characters.',
            ]
        );

        $attributes = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $user = $this->userService->createUser($attributes);

        $userId = '';
        if (is_string($user['id'])) {
            $userId = $user['id'];
        }

        return response()->json($user, 201)->header('Location', url('api/users/'.$userId));
    }
}
