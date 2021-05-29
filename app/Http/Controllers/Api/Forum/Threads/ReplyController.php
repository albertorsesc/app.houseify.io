<?php

namespace App\Http\Controllers\Api\Forum\Threads;

use App\Models\Forum\Threads\Reply;
use App\Models\Forum\Threads\Thread;
use App\Http\Controllers\Controller;
use App\Http\Requests\Forum\Threads\ReplyRequest;
use App\Http\Resources\Forum\Threads\ReplyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReplyController extends Controller
{
    public function index(Thread $thread) : AnonymousResourceCollection
    {
        return ReplyResource::collection(
            Reply::query()
                 ->where('thread_id', $thread->id)
                 ->with('author')
                 ->get()
        );
    }

    public function store(Thread $thread, ReplyRequest $request) : ReplyResource
    {
        return new ReplyResource(
            $thread->replies()
                   ->create($request->all())
                   ->load([
                       'thread:id,slug',
                       'author:id,first_name,last_name,email,profile_photo_path'
                   ])
        );
    }

    public function update(ReplyRequest $request, Thread $thread, Reply $reply) : ReplyResource
    {
        return new ReplyResource(
            tap($reply)
                ->update($request->all())
                ->load([
                    'thread:id',
                    'author:id,first_name,last_name,email,profile_photo_path'
                ])
        );
    }

    public function destroy(Thread $thread, Reply $reply)
    {
        $reply->delete();

        return response([], 204);
    }
}
