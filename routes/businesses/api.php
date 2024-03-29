<?php

    use App\Http\Controllers\Api\Businesses\Actions\LikeController;
    use App\Http\Controllers\Api\Businesses\BusinessController;
    use App\Http\Controllers\Api\Businesses\Inventory\ProductController;
    use App\Http\Controllers\Api\Businesses\MyBusinessController;
    use App\Http\Controllers\Api\Businesses\Actions\ReportBusinessController;
    use App\Http\Controllers\Api\Businesses\Actions\InterestBusinessController;

    Route::post('businesses/{business:slug}/location', [\App\Http\Controllers\Api\Businesses\LocationController::class, 'store'])->name('businesses.location.store');
    Route::put('businesses/{business:slug}/location', [\App\Http\Controllers\Api\Businesses\LocationController::class, 'update'])->name('businesses.location.update');

    Route::post('businesses/{business:slug}/interested', [InterestBusinessController::class, 'store'])->name('businesses.interested');
    Route::delete('businesses/{business:slug}/uninterested', [InterestBusinessController::class, 'destroy'])->name('businesses.uninterested');

    Route::post('businesses/{business:slug}/like', [LikeController::class, 'store'])->name('businesses.likes.store');
    Route::delete('businesses/{business:slug}/dislike', [LikeController::class, 'destroy'])->name('businesses.likes.destroy');

    Route::put('businesses/{business:slug}/toggle', \App\Http\Controllers\Api\Businesses\Actions\PublishController::class)->name('businesses.toggle');


    Route::get('me/businesses', MyBusinessController::class)->name('me.businesses');
    Route::get('me/businesses/interested', \App\Http\Controllers\Api\Businesses\MyInterestedBusinessesController::class)->name('me.businesses.interested');

    Route::post('businesses/{business:slug}/report', ReportBusinessController::class)->name('businesses.report');

    Route::apiResource('businesses', BusinessController::class);

    /* Inventory */
    Route::get('businesses/{business}/products', [ProductController::class, 'index'])->name('businesses.products.index');
    Route::post('businesses/{business}/products', [ProductController::class, 'store'])->name('businesses.products.store');
    Route::put('businesses/{business}/products/{product}', [ProductController::class, 'update'])->name('businesses.products.update');
    Route::delete('businesses/{business}/products/{product}', [ProductController::class, 'destroy'])->name('businesses.products.destroy');

