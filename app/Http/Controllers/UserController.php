<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return response()->json([
            'message' => 'Modelo creado exitosamente',
            'data' => $user
        ]);
    }

    public function login(Request $request)
    {
        ['email' => $email, 'password' => $password] =  $request;

        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            return response()->json([
                'name' => $user->name,
                'email' => $user->email
            ], 200);
        } else {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
    }
}
