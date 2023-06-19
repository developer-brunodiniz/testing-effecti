<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->increments('id')->unsigned();
            $table->integer('status')->unsigned();
            $table->string('cnpj', 18)->nullable(true);
            $table->string('name_fantasy', 50);
            $table->string('corporate_reason', 80)->nullable(true);
            $table->string('address', 255)->nullable(true);
            $table->string('cell_phone', 15)->nullable(true);
            $table->string('email', 45);
            $table->timestamps();

            $table->foreign('status')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
