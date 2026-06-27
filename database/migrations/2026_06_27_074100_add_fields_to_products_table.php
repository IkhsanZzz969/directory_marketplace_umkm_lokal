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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('original_price', 12, 2)->nullable()->after('price');
            $table->string('unit')->nullable()->default('pcs / buah')->after('original_price');
            $table->unsignedInteger('min_order')->default(1)->after('unit');
            $table->unsignedInteger('weight')->nullable()->after('min_order');
            $table->string('stock_status')->default('available')->after('weight');
            $table->unsignedInteger('preorder_days')->nullable()->after('stock_status');
            $table->string('preorder_unit')->nullable()->after('preorder_days');
            $table->json('tags')->nullable()->after('preorder_unit');
            $table->text('shipping_note')->nullable()->after('tags');
            $table->decimal('dimension_length', 8, 2)->nullable()->after('shipping_note');
            $table->decimal('dimension_width', 8, 2)->nullable()->after('dimension_length');
            $table->decimal('dimension_height', 8, 2)->nullable()->after('dimension_width');
            $table->string('status')->default('active')->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'original_price', 'unit', 'min_order', 'weight',
                'stock_status', 'preorder_days', 'preorder_unit',
                'tags', 'shipping_note',
                'dimension_length', 'dimension_width', 'dimension_height',
                'status',
            ]);
        });
    }
};
