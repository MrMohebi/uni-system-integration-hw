<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if(password_verify($password, $user->password)) {
            return Response::json(['token' => $user->token]);
        }else{
            return Response::json([
                'password' => "invalid"
            ], 401);
        }

    }
    public function signup(Request $request): JsonResponse
    {
        $username = $request->input('username');
        $name = $request->input('name');
        $lastname = $request->input('lastName');
        $password = $request->input('password');
        $phone = $request->input('phone');
        $email = $request->input('email');

        $user = User::create([
            "name" => $name,
            "lastName" => $lastname,
            "username" => $username,
            "password"=>password_hash($password, PASSWORD_DEFAULT),
            "email"=>$email,
            "phone"=>$phone,
            "token"=>Str::random(32)
        ]);

        return Response::json($user);
    }

    public function update(Request $request): JsonResponse
    {
        $name = $request->input('name');
        $lastname = $request->input('lastName');
        $password = $request->input('password');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $token = $request->header('token');

        User::where("token", $token)->update([
            "name" => $name,
            "lastName" => $lastname,
            "password"=>password_hash($password, PASSWORD_DEFAULT),
            "email"=>$email,
            "phone"=>$phone,
        ]);

        $user = User::where("token", $token)->first();
        return Response::json($user);
    }
}
