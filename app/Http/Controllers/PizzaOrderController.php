<?php

// app/Http/Controllers/PizzaOrderController.php

namespace App\Http\Controllers;

use App\Models\PizzaOrder;
use Illuminate\Http\Request;

class PizzaOrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'pizza_type' => 'required|string',
            'pizza_size' => 'required|string',
            'topping' => 'nullable|array',
            'estimated_price' => 'required|numeric',
        ]);

        // printf($data['topping']);
        $pizzaOrder = PizzaOrder::create($data);



        // Return a JSON response
        return response()->json(['message' => 'Pizza order placed/stored successfully']);
    }
}