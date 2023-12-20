<!-- resources/views/pizza/index.blade.php -->

@extends('layouts.app')

@section('content')
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <h1>Pizza Ordering System</h1>


    <form action="{{ url('/order') }}" method="post">
        @csrf

        <label for="pizza_type">Pizza Type:</label>
        <select name="pizza_type" id="pizza_type" onchange="updateEstimatedPrice()">
            <option value="" disabled selected>Select Pizza Type</option>
            <option value="Farmhouse">Farmhouse</option>
            <option value="Margarita">Margarita</option>
            <option value="Peppy Paneer">Peppy Paneer</option>
        </select>

        <br>

        <label for="pizza_size">Pizza Size:</label>
        <select name="pizza_size" id="pizza_size" onchange="updateEstimatedPrice()">
            <option value="" disabled selected>Select Pizza Size</option>
            <option value="Large" data-price="15">Large</option>
            <option value="Medium" data-price="12">Medium</option>
            <option value="Small" data-price="10">Small</option>
        </select>

        <br>

        <label>Choose Toppings:</label>
        <input type="checkbox" name="topping[]" value="Extra Cheese" onchange="updateEstimatedPrice()"> Extra Cheese
        <input type="checkbox" name="topping[]" value="Jalapenos" onchange="updateEstimatedPrice()"> Jalapenos
        <input type="checkbox" name="topping[]" value="Sweet Corn" onchange="updateEstimatedPrice()"> Sweet Corn
        <input type="checkbox" name="topping[]" value="Extra Veggies" onchange="updateEstimatedPrice()"> Extra Veggies

        <br>

        <p><strong>Estimated Price:</strong> $<span id="estimatedPrice">0.00</span></p>

        <input type="hidden" name="place_order" value="1">

        <button type="submit">Place Order</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const estimatedPrice = document.getElementById('estimatedPrice');
            let formData = new FormData();  // Declare formData at the global level

            function updateEstimatedPrice() {
                const pizzaType = form.querySelector('#pizza_type').value;
                const pizzaSize = form.querySelector('#pizza_size').value;
                const selectedToppings = Array.from(form.querySelectorAll('input[name="topping[]"]:checked')).map(topping => topping.value);

                const pizzaPrice = calculatePizzaPrice(pizzaType, pizzaSize);
                const toppingPrice = calculateToppingPrice(selectedToppings, pizzaSize);
                const totalEstimatedPrice = pizzaPrice + toppingPrice;

                estimatedPrice.textContent = totalEstimatedPrice.toFixed(2);

                // Clear and update the calculated estimated price in the formData
                formData = new FormData(form);
                formData.set('estimated_price', totalEstimatedPrice.toFixed(2));
            }

            function calculatePizzaPrice(type, size) {
                if (!type || !size) {
                    return 0;
                }

                const sizePrice = parseFloat(form.querySelector(`#pizza_size option[value="${size}"]`).getAttribute('data-price'));
                const typePrices = {
                    'Farmhouse': 0,
                    'Margarita': 2,
                    'Peppy Paneer': 1.5,
                };

                return sizePrice + typePrices[type];
            }

            function calculateToppingPrice(toppings, size) {
                if (!toppings || !size) {
                    return 0;
                }

                const toppingPrices = {
                    'Extra Cheese': {'Large': 2, 'Medium': 1.5, 'Small': 1},
                    'Jalapenos': {'Large': 1.5, 'Medium': 1, 'Small': 0.5},
                    'Sweet Corn': {'Large': 1, 'Medium': 0.8, 'Small': 0.5},
                    'Extra Veggies': {'Large': 2, 'Medium': 1.5, 'Small': 1},
                };

                let toppingPrice = 0;

                toppings.forEach(topping => {
                    toppingPrice += toppingPrices[topping][size] || 0;
                });

                return toppingPrice;
            }

            form.addEventListener('input', function () {
                updateEstimatedPrice();
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                submitForm();
            });

            console.log(formData);

            async function submitForm() {
                try {
                    // Send the form data to the server
                    const response = await fetch('/order', {
                        method: 'POST',
                        body: formData,
                    });

                    if (!response.ok) {
                        throw new Error('Failed to submit form');
                    }

                    const data = await response.json();
                    // Handle the response, e.g., show a success message
                    console.log(data);
                } catch (error) {
                    // Handle errors, e.g., show an error message
                    console.error(error);
                }
            }
        });
    </script>

@endsection
