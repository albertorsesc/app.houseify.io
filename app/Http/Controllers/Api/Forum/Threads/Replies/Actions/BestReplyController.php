<?php

namespace App\Http\Controllers\Api\Forum\Threads\Replies\Actions;

use App\Http\Controllers\Controller;
use App\Models\Forum\Threads\{Reply, Thread};

class BestReplyController extends Controller
{
    public function __invoke(Thread $thread, Reply $reply)
    {
        $this->authorize('update', $thread);

        $thread->toggleBestReply($reply);

        return response()->json(['isBest' => $reply->isBest()]);
    }
}
