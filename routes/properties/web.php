<?php

    use App\Http\Controllers\Web\Properties\PropertyController;

    Route::get('propiedades/{property:slug}', PropertyController::class)->name('web.properties.show');
