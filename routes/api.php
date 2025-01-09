<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MidtransController;

Route::post('/midtrans/callback', [MidtransController::class, 'callback']);