<?php

use ImetCore\Helpers\Database;
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
        Schema::create(Database::getTable(Database::IMET_SCHEMA, 'scaling_up_basket'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order');
            $table->string('item', 500)->nullable();
            $table->text('comment')->nullable();
            $table->integer('scaling_up_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Database::getTable(Database::IMET_SCHEMA, 'scaling_up_basket'));
    }
};
