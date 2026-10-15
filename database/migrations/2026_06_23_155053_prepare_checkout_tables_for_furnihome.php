<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (!Schema::hasColumn('orders', 'order_number')) {
                    $table->string('order_number')->nullable()->unique()->after('user_id');
                }

                if (!Schema::hasColumn('orders', 'subtotal')) {
                    $table->decimal('subtotal', 10, 2)->default(0)->after('order_number');
                }

                if (!Schema::hasColumn('orders', 'delivery_fee')) {
                    $table->decimal('delivery_fee', 10, 2)->default(0)->after('subtotal');
                }

                if (!Schema::hasColumn('orders', 'installation_fee')) {
                    $table->decimal('installation_fee', 10, 2)->default(0)->after('delivery_fee');
                }

                if (!Schema::hasColumn('orders', 'total')) {
                    $table->decimal('total', 10, 2)->default(0)->after('installation_fee');
                }

                if (!Schema::hasColumn('orders', 'status')) {
                    $table->string('status')->default('pending')->after('total');
                }
            });
        }

        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $table) {
                if (!Schema::hasColumn('order_items', 'product_variant_id')) {
                    $table->foreignId('product_variant_id')
                        ->nullable()
                        ->after('product_id')
                        ->constrained('product_variants')
                        ->nullOnDelete();
                }

                if (!Schema::hasColumn('order_items', 'price')) {
                    $table->decimal('price', 10, 2)->default(0)->after('quantity');
                }

                if (!Schema::hasColumn('order_items', 'total')) {
                    $table->decimal('total', 10, 2)->default(0)->after('price');
                }
            });
        }

        if (Schema::hasTable('payments')) {
            Schema::table('payments', function (Blueprint $table) {
                if (!Schema::hasColumn('payments', 'payment_method')) {
                    $table->string('payment_method')->nullable()->after('order_id');
                }

                if (!Schema::hasColumn('payments', 'payment_status')) {
                    $table->string('payment_status')->default('pending')->after('payment_method');
                }

                if (!Schema::hasColumn('payments', 'amount')) {
                    $table->decimal('amount', 10, 2)->default(0)->after('payment_status');
                }

                if (!Schema::hasColumn('payments', 'transaction_reference')) {
                    $table->string('transaction_reference')->nullable()->after('amount');
                }
            });
        }

        if (Schema::hasTable('deliveries')) {
            Schema::table('deliveries', function (Blueprint $table) {
                if (!Schema::hasColumn('deliveries', 'full_name')) {
                    $table->string('full_name')->nullable()->after('order_id');
                }

                if (!Schema::hasColumn('deliveries', 'phone')) {
                    $table->string('phone')->nullable()->after('full_name');
                }

                if (!Schema::hasColumn('deliveries', 'city')) {
                    $table->string('city')->nullable()->after('phone');
                }

                if (!Schema::hasColumn('deliveries', 'address')) {
                    $table->text('address')->nullable()->after('city');
                }

                if (!Schema::hasColumn('deliveries', 'delivery_note')) {
                    $table->text('delivery_note')->nullable()->after('address');
                }

                if (!Schema::hasColumn('deliveries', 'delivery_fee')) {
                    $table->decimal('delivery_fee', 10, 2)->default(0)->after('delivery_note');
                }

                if (!Schema::hasColumn('deliveries', 'status')) {
                    $table->string('status')->default('pending')->after('delivery_fee');
                }
            });
        }

        if (Schema::hasTable('installations')) {
            Schema::table('installations', function (Blueprint $table) {
                if (!Schema::hasColumn('installations', 'is_requested')) {
                    $table->boolean('is_requested')->default(false)->after('order_id');
                }

                if (!Schema::hasColumn('installations', 'installation_fee')) {
                    $table->decimal('installation_fee', 10, 2)->default(0)->after('is_requested');
                }

                if (!Schema::hasColumn('installations', 'status')) {
                    $table->string('status')->default('not_requested')->after('installation_fee');
                }
            });
        }
    }

    public function down(): void
    {
        //
    }
};