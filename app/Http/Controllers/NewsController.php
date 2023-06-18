<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class NewsController extends Controller
{
    public function new(Request $request): JsonResponse
    {
        $token = $request->header('token');

        $title = $request->input('title');
        $description = $request->input('description');
        $channelId = $request->input('channelId');

        if (!($user = User::where("token", $token)->first())) {
            return Response::json([], 401);
        }

        $news = News::create([
            "title" => $title,
            "description" => $description,
            "channelId" => $channelId,
            "creatorId" => $user->id,
        ]);


        return Response::json($news);
    }

    public function last(string $channelId, Request $request): JsonResponse
    {
        $token = $request->header('token');

        $number = $request->input('number');

        if (!User::where("token", $token)->exists()) {
            return Response::json([], 401);
        }

        $news = News::where([
            "channelId" => $channelId,
            "isConfirmed"=>true,
        ])->limit($number ?? 3)->orderBy('updated_at', 'desc')->get();



        return Response::json($news);
    }

    public function confirm(string $id): JsonResponse
    {
        $news = News::find($id)->update([
            "isConfirmed"=>true,
        ]);

        return Response::json($news);
    }

}
