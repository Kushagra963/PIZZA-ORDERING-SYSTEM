<?php

// app/Http/Controllers/PizzaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
    {
        return view('pizza.index');
    }

    public function placeOrder(Request $request)
    {
        // Handle the order logic here
        // Retrieve the selected pizza type, size, toppings, etc., from $request
        $pizzaType = $request->input('pizza_type');
        $pizzaSize = $request->input('pizza_size');
        $selectedToppings = $request->input('topping');

        // Perform pricing logic based on the selected options
        $pizzaPrice = $this->calculatePizzaPrice($pizzaType, $pizzaSize);
        $toppingPrice = $this->calculateToppingPrice($selectedToppings, $pizzaSize);

        // Calculate total price
        $totalPrice = $pizzaPrice + $toppingPrice;

        return view('pizza.order-confirmation', compact('pizzaType', 'pizzaSize', 'selectedToppings', 'totalPrice'));
    }

    private function calculatePizzaPrice($type, $size)
    {
        // Pricing logic for each pizza type and size
        // You can customize this based on your pricing structure
        // For demonstration purposes, using a simple example
        $prices = [
            'Farmhouse' => ['Large' => 15, 'Medium' => 12, 'Small' => 10],
            'Margarita' => ['Large' => 12, 'Medium' => 10, 'Small' => 8],
            'Peppy Paneer' => ['Large' => 14, 'Medium' => 11, 'Small' => 9],
        ];

        return $prices[$type][$size] ?? 0;
    }

    private function calculateToppingPrice($toppings, $size)
    {
        // Pricing logic for each topping and size
        // You can customize this based on your pricing structure
        // For demonstration purposes, using a simple example
        $toppingPrices = [
            'Extra Cheese' => ['Large' => 2, 'Medium' => 1.5, 'Small' => 1],
            'Jalapenos' => ['Large' => 1.5, 'Medium' => 1, 'Small' => 0.5],
            'Sweet Corn' => ['Large' => 1, 'Medium' => 0.8, 'Small' => 0.5],
            'Extra Veggies' => ['Large' => 2, 'Medium' => 1.5, 'Small' => 1],
        ];

        $toppingPrice = 0;

        foreach ($toppings as $topping) {
            $toppingPrice += $toppingPrices[$topping][$size] ?? 0;
        }

        return $toppingPrice;
    }
}



?>
