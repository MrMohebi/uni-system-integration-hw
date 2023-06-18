<?php

namespace App\Http\Controllers;

use App\Models\Update_profile_ticket;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UpdateProfileTicketController extends Controller
{
    public function removeAccount(Request $request): JsonResponse
    {
        $token = $request->header('token');

        $phone = $request->input('phone');

        if(!($user = User::where("token", $token)->first())){
            return Response::json([],404);
        }

        $update_profile_ticket = Update_profile_ticket::create([
            "phone"=>$phone,
            "userId"=>$user->id,
            "toBeDeleted"=>true,
        ]);


        return Response::json($update_profile_ticket);
    }
    public function updateAccount(Request $request): JsonResponse
    {
        $token = $request->header('token');

        $name = $request->input('name');
        $lastname = $request->input('lastName');
        $password = $request->input('password');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $subs = json_decode($request->input('subs'));

        if(!($user = User::where("token", $token)->first())){
            return Response::json([],404);
        }

        $update_profile_ticket = Update_profile_ticket::create([
            "name" => $name,
            "lastName" => $lastname,
            "password"=>password_hash($password, PASSWORD_DEFAULT),
            "email"=>$email,
            "phone"=>$phone,
            "subs" => json_encode($subs),
            "userId"=>$user->id
        ]);


        return Response::json($update_profile_ticket);
    }
}
