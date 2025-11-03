<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use ModularForms\Controllers\UploadFileController;

Route::middleware(['web'])->group(function (): void {

    Route::get('/', fn (): View => view('index'))->name('home');

    // Debug/dev
    Route::get('info', phpinfo(...))->name('info');

    // ###### File upload/download ######
    Route::post('file/upload', [UploadFileController::class, 'upload'])->name('upload.file');
    Route::get('file/{hash}', [UploadFileController::class, 'download'])->name('file');

});
