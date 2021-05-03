<?php

    use App\Http\Controllers\Api\Forum\Threads\ThreadController;
    use App\Http\Controllers\Api\Forum\Threads\ReplyController;

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('threads/{thread}/replies', [ReplyController::class, 'store'])->name('threads.replies.store');
        Route::post('threads', [ThreadController::class, 'store'])->name('threads.store');
    });

    Route::get('threads', [ThreadController::class, 'index'])->name('threads.index');
    Route::get('threads/{thread}/replies', [ReplyController::class, 'index'])->name('threads.replies.index');
