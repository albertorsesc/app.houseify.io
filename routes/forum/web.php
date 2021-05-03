<?php

Route::prefix('forum')->group(function () {
    Route::get('temas', [\App\Http\Controllers\Web\Forum\Threads\ThreadController::class, 'index'])->name('web.forum.threads.index');
    Route::get('temas/{thread}', [\App\Http\Controllers\Web\Forum\Threads\ThreadController::class, 'show'])->name('web.forum.threads.show');
});
