<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('material_unit_sizes', function (Blueprint $table) {
            $table->id();
            $table->string('Unit_Size');
            $table->timestamps();
        });

        Schema::create('material_categories', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->timestamps();
        });

        Schema::create('material_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('Status');
            $table->timestamps();
        });

        Schema::create('pricebooks', function (Blueprint $table) {
            $table->id();
            $table->string('SKU');
            $table->string('Name');
            $table->foreignId('fk_unit_size')->constrained(table: 'material_unit_sizes');
            $table->decimal('PB_FY24_1', 10, 2)->nullable()->default(NULL);
            $table->enum('PB_FY24_1_Status', ['New', 'Removed', 'Obsolete'])->nullable();
            $table->decimal('PB_FY23_3', 10, 2)->nullable()->default(NULL);
            $table->enum('PB_FY23_3_Status', ['New', 'Removed', 'Obsolete'])->nullable();
            $table->boolean('Discountable');
            $table->foreignId('fk_category')->constrained(table: 'material_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricebooks');
        Schema::dropIfExists('material_status');
        Schema::dropIfExists('material_category');
        Schema::dropIfExists('material_unit_size');
    }
};