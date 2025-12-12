<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerateTokenController extends Controller
{
    public function __construct(protected UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     *
     * @throws InvalidCredentialsException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate(
            [
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

        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if (Auth::attempt($credentials) === false) {
            throw new InvalidCredentialsException('Invalid credentials.');
        }

        $user = Auth::user();
        if (! $user instanceof User) {
            throw new InvalidCredentialsException('Authentication error.');
        }

        /** @var \Laravel\Sanctum\NewAccessToken $accessToken */
        $accessToken = $user->createToken('token');

        $token = $accessToken->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ]);
    }
}
