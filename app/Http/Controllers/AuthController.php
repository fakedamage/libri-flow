<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Método para registrar o usuário
    public function sign_up(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $credentials = ["email" => $request->email, "password" => $request->password];

        $result = $this->authorize_sign_in($credentials);

        if (isset($result['token']) && asset($result['token']))
            return $result;


        return response()->json(['message' => 'User created successfully!'], 201);
    }

    // Método para realizar o login (sign-in)
    public function sign_in(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $result = $this->authorize_sign_in($credentials);
        if (isset($result['token']) && asset($result['token']))
            return $result;

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    private function authorize_sign_in($credentials)
    {

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('LibriFlow')->plainTextToken;
            return ['token' => $token, 'user' => $user];
        }

        return ['message' => 'Unauthorized'];
    }
}
