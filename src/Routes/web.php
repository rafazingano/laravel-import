<?php

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['web', 'auth'])
    ->namespace('ConfrariaWeb\Import\Controllers')
    ->group(function () {

        Route::resource('imports', 'ImportController');
        Route::name('imports.')->prefix('imports')->group(function () {
            Route::get('execute/{id}', 'ImportController@execute')->name('execute');

        });

    });
