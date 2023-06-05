<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'vendors'], function () {
    Route::get('/', [\App\Http\Modules\Vendors\Controllers\VendorsListController::class, '__invoke'])
        ->name('vendors.list');

    Route::post('/', [
        \App\Http\Modules\Vendors\Controllers\VendorsCreateController::class,
        '__invoke'
    ])->name('vendors.create');

    Route::group(['prefix' => '{vendor_id}'], function () {
        Route::get('/', [
            \App\Http\Modules\Vendors\Controllers\VendorsGetController::class,
            '__invoke'
        ])->name('vendors.get');

        Route::put('/', [
            \App\Http\Modules\Vendors\Controllers\VendorsUpdateController::class,
            '__invoke'
        ])->name('vendors.update');

        Route::delete('/', [
            \App\Http\Modules\Vendors\Controllers\VendorsDeleteController::class,
            '__invoke'
        ])->name('vendors.delete');
    });
});

