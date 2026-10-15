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
       Schema::create('orders', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
          ->constrained('users')
          ->onDelete('cascade');

    $table->foreignId('address_id')
          ->constrained('addresses')
          ->onDelete('cascade');

    $table->string('order_number')->unique();

    $table->decimal('subtotal', 10, 2);
    $table->decimal('delivery_fee', 10, 2)->default(0);
    $table->decimal('installation_fee', 10, 2)->default(0);
    $table->decimal('total', 10, 2);

    $table->enum('order_status', [
        'pending',
        'confirmed',
        'preparing',
        'out_for_delivery',
        'delivered',
        'installation_scheduled',
        'installed',
        'completed',
        'cancelled'
    ])->default('pending');

    $table->enum('payment_status', [
        'unpaid',
        'paid',
        'failed',
        'refunded'
    ])->default('unpaid');

    $table->boolean('installation_required')->default(false);
    $table->date('preferred_delivery_date')->nullable();
    $table->text('notes')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
