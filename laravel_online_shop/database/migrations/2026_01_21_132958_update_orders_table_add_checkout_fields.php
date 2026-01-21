<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // Payment
            $table->string('payment_method')->after('status');
            // cod / wallet / card

            $table->string('payment_status')
                ->default('unpaid')
                ->after('payment_method');
            // unpaid / paid / refunded

            // Shipping & totals
            $table->decimal('shipping_fee', 10, 2)
                ->default(0)
                ->after('discount');

            // Shipping info
            $table->string('shipping_name')->after('total');
            $table->string('shipping_phone')->after('shipping_name');
            $table->text('shipping_address')->after('shipping_phone');
            $table->string('shipping_city')->after('shipping_address');
            $table->text('shipping_notes')->nullable()->after('shipping_city');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payment_status',
                'shipping_fee',
                'shipping_name',
                'shipping_phone',
                'shipping_address',
                'shipping_city',
                'shipping_notes',
            ]);
        });
    }
};
