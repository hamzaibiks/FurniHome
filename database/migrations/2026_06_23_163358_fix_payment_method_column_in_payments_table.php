<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('payments', 'payment_method')) {
            DB::statement("ALTER TABLE payments MODIFY payment_method VARCHAR(50) NULL");
        }

        if (Schema::hasColumn('payments', 'method')) {
            DB::statement("ALTER TABLE payments MODIFY method VARCHAR(50) NULL");
        }

        if (Schema::hasColumn('payments', 'payment_status')) {
            DB::statement("ALTER TABLE payments MODIFY payment_status VARCHAR(50) DEFAULT 'pending'");
        }

        if (Schema::hasColumn('payments', 'status')) {
            DB::statement("ALTER TABLE payments MODIFY status VARCHAR(50) DEFAULT 'pending'");
        }
    }

    public function down(): void
    {
        //
    }
};