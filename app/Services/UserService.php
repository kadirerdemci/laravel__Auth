<?php

namespace App\Services;

use App\Core\ServiceResponse;
use App\Interfaces\IUserService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{



    public function register(string $name, string $email, string $password): ServiceResponse
    {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password= $password;
        $user->save();
        return new ServiceResponse(true, 'User created successfully', $user,201);
    }

    public function login(string $email, string $password): ServiceResponse
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            return new ServiceResponse(false, 'User not found or password is incorrect', null, 401);
        }
        if (!Hash::check($password, $user->password)) {
            return new ServiceResponse(false, 'User not found or password is incorrect', null, 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return new ServiceResponse(true, 'User logged in successfully', [
            'token' => $token,
            'user' => [
                'name' => $user->name,
                'email'=>$user->email,
            ]
        ], 200);
    }


}
