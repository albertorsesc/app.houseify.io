<?php

namespace App\Http\Controllers\Api\Forum\Threads;

use App\Models\Forum\Threads\Thread;
use App\Http\Controllers\Controller;
use App\Http\Requests\Forum\Threads\ThreadRequest;
use App\Http\Resources\Forum\Threads\ThreadResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;


class ThreadController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        $threads = Thread::query()->with('author')->withCount('replies');

        if (
            request()->has('channel') &&
            in_array(request()->channel, config('houseify.construction_categories'))
        ) {
            $threads->where('channel', request()->channel);
        }

        if (request()->has('search')) {
            $threads->where(
                'title',
                'LIKE',
                '%' . request()->search . '%'
            )->orWhere(
                'body',
                'LIKE',
                '%' . request()->search . '%'
            );
        }

        return ThreadResource::collection($threads->latest()->get());
    }

    public function store(ThreadRequest $request) : ThreadResource
    {
        $this->authorize('create', Thread::class);

        return new ThreadResource(
            Thread::create(
                $request->all()
            )->load('author:id,first_name,last_name,email,profile_photo_path')
        );
    }

    public function update(ThreadRequest $request, Thread $thread) : ThreadResource
    {
        $this->authorize('update', $thread);

        return new ThreadResource(
            tap($thread)
                ->update($request->all())
                ->load('author:id,first_name,last_name,email,profile_photo_path')
        );
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();

        return response([], 204);
    }
}
