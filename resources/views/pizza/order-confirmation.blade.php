<!-- resources/views/pizza/order-confirmation.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Order Confirmation</h1>

    <p>Your pizza order has been placed successfully!</p>

    <p><strong>Pizza Type:</strong> {{ $pizzaType }}</p>
    <p><strong>Pizza Size:</strong> {{ $pizzaSize }}</p>
    
    @if(count($selectedToppings) > 0)
        <p><strong>Selected Toppings:</strong> {{ implode(', ', $selectedToppings) }}</p>
    @else
        <p>No toppings selected</p>
    @endif

    <p><strong>Thank you for your order!</strong></p>
@endsection
