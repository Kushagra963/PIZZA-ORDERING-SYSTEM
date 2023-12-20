<?php

// database/migrations/xxxx_xx_xx_create_pizza_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzaOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('pizza_orders', function (Blueprint $table) {
            $table->id();
            $table->string('pizza_type');
            $table->string('pizza_size');
            $table->json('topping')->nullable();
            $table->decimal('estimated_price', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pizza_orders');
    }
}
