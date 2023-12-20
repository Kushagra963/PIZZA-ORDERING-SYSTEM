<?php

use Illuminate\Support\Facades\Route;

// routes/web.php

use App\Http\Controllers\PizzaController;
use App\Http\Controllers\PizzaOrderController;


Route::get('/', [PizzaController::class, 'index']);

Route::post('/order', [PizzaOrderController::class, 'store'])->name("order");

// Route::post('/order', [PizzaController::class, 'placeOrder']);



