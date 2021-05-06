<?php

namespace App\Http\Controllers\Api\Forum\Threads;

use App\Models\Forum\Thread;
use App\Models\Forum\Threads\Reply;
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
                       'thread:id',
                       'author:id,first_name,last_name'
                   ])
        );
    }
}
