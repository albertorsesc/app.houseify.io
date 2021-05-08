<?php

namespace App\Http\Controllers\Api\Forum\Threads;

use App\Http\Requests\Forum\Threads\ThreadRequest;
use App\Inspections\Spam;
use App\Models\Forum\Thread;
use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Threads\ThreadResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ThreadController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        return ThreadResource::collection(
            Thread::with('author')
                  ->latest()
                  ->get()
        );
    }

    public function store(ThreadRequest $request) : ThreadResource
    {
        return new ThreadResource(
            Thread::create([
                'title' => $request->title,
                'body' => $request->body,
                'author_id' => auth()->id()
            ])->load('author:id,first_name,last_name,email,profile_photo_path')
        );
    }
}
