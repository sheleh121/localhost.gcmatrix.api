<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'files'], function () {
    Route::get('/', [\App\Http\Modules\Files\Controllers\FilesListController::class, '__invoke'])
        ->name('files.list');

    Route::post('/', [
        \App\Http\Modules\Files\Controllers\FilesCreateController::class,
        '__invoke'
    ])->name('files.create');

    Route::group(['prefix' => '{file_id}'], function () {
        Route::get('/', [
            \App\Http\Modules\Files\Controllers\FilesGetController::class,
            '__invoke'
        ])->name('files.get');

        Route::put('/', [
            \App\Http\Modules\Files\Controllers\FilesUpdateController::class,
            '__invoke'
        ])->name('files.update');

        Route::delete('/', [
            \App\Http\Modules\Files\Controllers\FilesDeleteController::class,
            '__invoke'
        ])->name('files.delete');
    });
});

