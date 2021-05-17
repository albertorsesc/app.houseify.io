<?php

    use App\Http\Controllers\Api\Forum\Threads\Actions\ThreadsByChannelController;
    use App\Http\Controllers\Api\Forum\Threads\ThreadController;
    use App\Http\Controllers\Api\Forum\Threads\ReplyController;
    use App\Http\Controllers\Api\Forum\Threads\Replies\Actions\BestReplyController;

    Route::middleware('auth:sanctum')->group(function () {
        Route::put('threads/{thread}/replies/{reply}', [ReplyController::class, 'update'])->name('threads.replies.update');
        Route::delete('threads/{thread}/replies/{reply}', [ReplyController::class, 'destroy'])->name('threads.replies.destroy');
        Route::post('threads/{thread}/replies', [ReplyController::class, 'store'])->name('threads.replies.store');
        Route::put('threads/{thread}/replies/{reply}/best', BestReplyController::class)->name('threads.replies.best.store');


        Route::post('threads', [ThreadController::class, 'store'])->name('threads.store');
        Route::put('threads/{thread}', [ThreadController::class, 'update'])->name('threads.update');
        Route::delete('threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');
    });

    Route::get('threads', [ThreadController::class, 'index'])->name('threads.index');
    Route::get('threads/{thread}/replies', [ReplyController::class, 'index'])->name('threads.replies.index');
