<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'manufacturers'], function () {
    Route::get('/', [\App\Http\Modules\Manufacturers\Controllers\ManufacturersListController::class, '__invoke'])
        ->name('manufacturers.list');

    Route::post('/', [
        \App\Http\Modules\Manufacturers\Controllers\ManufacturersCreateController::class,
        '__invoke'
    ])->name('manufacturers.create');

    Route::group(['prefix' => '{manufacturer_id}'], function () {
        Route::get('/', [
            \App\Http\Modules\Manufacturers\Controllers\ManufacturersGetController::class,
            '__invoke'
        ])->name('manufacturers.get');

        Route::put('/', [
            \App\Http\Modules\Manufacturers\Controllers\ManufacturersUpdateController::class,
            '__invoke'
        ])->name('manufacturers.update');

        Route::delete('/', [
            \App\Http\Modules\Manufacturers\Controllers\ManufacturersDeleteController::class,
            '__invoke'
        ])->name('manufacturers.delete');
    });
});

