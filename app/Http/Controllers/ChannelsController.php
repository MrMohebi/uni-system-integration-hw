<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ChannelsController extends Controller
{
    public function list(): JsonResponse
    {
        $channels = Channel::all();
        return Response::json($channels);
    }
}
