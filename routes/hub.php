<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\MyCustomPage;

Route::middleware([
    'web',
    config('lunar-hub.middleware.authenticate'),
])
    ->prefix(config('lunar-hub.routes.prefix', 'admin'))
    ->name('hub.')
    ->group(function () {
        Route::get('/my-page', MyCustomPage::class)->name('my-page');
    });
