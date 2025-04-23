<?php

use Illuminate\Support\Facades\Route;
use Kingsley\NovaStatus\Http\Controllers\NovaStatusController;

Route::get('/', NovaStatusController::class);
