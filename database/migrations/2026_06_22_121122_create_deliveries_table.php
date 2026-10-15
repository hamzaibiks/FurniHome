<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
    $table->id();

    $table->foreignId('order_id')
          ->constrained('orders')
          ->onDelete('cascade');

    $table->foreignId('delivery_staff_id')
          ->nullable()
          ->constrained('users')
          ->onDelete('set null');

    $table->enum('delivery_status', [
        'waiting',
        'assigned',
        'on_the_way',
        'delivered',
        'failed'
    ])->default('waiting');

    $table->date('scheduled_date')->nullable();
    $table->dateTime('delivered_at')->nullable();
    $table->text('delivery_notes')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
