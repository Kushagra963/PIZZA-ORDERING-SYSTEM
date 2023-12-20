<?php

// app/Models/PizzaOrder.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaOrder extends Model
{
    use HasFactory;

    protected $fillable = ['pizza_type', 'pizza_size', 'toppings', 'estimated_price'];
}
