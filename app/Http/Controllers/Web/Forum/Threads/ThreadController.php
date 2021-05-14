<?php

namespace App\Http\Controllers\Web\Forum\Threads;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Threads\ThreadResource;
use App\Models\Forum\Threads\Thread;
use Illuminate\Http\Request;
use function view;

class ThreadController extends Controller
{
    public function index()
    {
        return view('forum.threads.index');
    }

    public function show(Thread $thread)
    {
        return view('forum.threads.show', [
            'thread' => new ThreadResource(
                $thread->load([
                    'replies.thread:id,best_reply_id',
                    'author:id,first_name,last_name,email,profile_photo_path',
                    'replies.author:id,first_name,last_name,email,profile_photo_path',
                ])
            )
        ]);
    }
}
