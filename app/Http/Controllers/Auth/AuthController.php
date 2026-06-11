<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'device_name'
        ]);

        try {

            User::firstOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'password' => $request->password
                ]
            );

        }catch (\Throwable $e)
        {
            dd($e->getMessage());
        }

        return response()->json(
            status: 201,
            data: ['message' => 'data stored successfuly']
        );


    }
    public function login(Request $request)
    {

        $validated = $request->validate(
            [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]
        );

        $user = User::where('email', $validated['email'])->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
            data: [
                'user' => $user,
                'token' => $token
            ], status: 201
        );
    }

}
