<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends Controller
{
    private $scope;

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);
        $user->newUser();

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken], 201);
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            $userRole = $user->role()->first();

            if ($userRole) {
                $this->scope = $userRole->role;
            }

            $token = $user->createToken($user->email . '-' . now(), [$this->scope]);

            return response()->json([
                'token' => $token->accessToken
            ]);
        }
    }
}
