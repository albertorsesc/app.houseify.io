<?php

namespace App\Http\Controllers\Web\Forum\Threads;

use App\Models\Forum\Threads\Thread;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\Forum\Threads\ThreadChannel;
use App\Http\Requests\Forum\Threads\ThreadRequest;
use App\Http\Resources\Forum\Threads\ThreadResource;

class ThreadController extends Controller
{
    public function index(ThreadChannel $channel)
    {
        if ($channel->exists) {
            $threads = $channel->threads()->with(['author', 'channel'])->withCount('replies')->latest()->get();
        } else {
            $threads = Thread::query()->with(['author', 'channel'])->withCount('replies')->latest()->get();
        }

        if (request()->has('busqueda')) {
            $threads = Thread::query()
                             ->where(
                                 'title',
                                 'LIKE',
                                 '%' . request()->get('busqueda') . '%'
                             )->OrWhere(
                                 'body',
                                 'LIKE',
                    '%' . request()->get('busqueda') . '%'
                )->latest()->get();
        }

        return view('forum.threads.index', [
            'threads' => $threads
        ]);
    }

    public function create()
    {
        return view('forum.threads.create', [
            'channels' => ThreadChannel::query()->orderBy('name')->get()
        ]);
    }

    public function store(ThreadRequest $request) : RedirectResponse
    {
        $this->authorize('create', Thread::class);

        Thread::create($request->all());

        return redirect()->action([self::class, 'index']);
    }

    public function show(ThreadChannel $channel, Thread $thread)
    {
        return view('forum.threads.show', [
            'thread' => new ThreadResource(
                $thread->load([
                    'replies.thread:id,slug,best_reply_id',
                    'author:id,first_name,last_name,email,profile_photo_path',
                    'replies.author:id,first_name,last_name,email,profile_photo_path',
                ])
            )
        ]);
    }
}
