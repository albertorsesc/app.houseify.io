<?php

Route::get('forum', [\App\Http\Controllers\Web\Forum\Threads\ThreadController::class, 'index'])->name('web.threads.index');
Route::get('forum/crear-consulta', [\App\Http\Controllers\Web\Forum\Threads\ThreadController::class, 'create'])->name('web.threads.create');
Route::post('threads', [\App\Http\Controllers\Web\Forum\Threads\ThreadController::class, 'store'])->name('web.threads.store');
Route::get('forum/{thread}', [\App\Http\Controllers\Web\Forum\Threads\ThreadController::class, 'show'])->name('web.threads.show');
