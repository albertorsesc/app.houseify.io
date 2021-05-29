<?php

namespace App\Http\Controllers\Api\Forum\Threads;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Forum\Threads\ThreadChannel;

class ThreadChannelController extends Controller
{
    public function __invoke() : JsonResponse
    {
        return response()->json([
            'data' => ThreadChannel::query()
                                   ->orderBy('name')
                                   ->get()
        ]);
    }
}
