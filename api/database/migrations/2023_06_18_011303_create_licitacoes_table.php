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
        Schema::create('licitacoes', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->increments('id')->unsigned();
            $table->integer('status')->unsigned();
            $table->integer('empresa')->unsigned();
            $table->integer('modalidade')->unsigned();
            $table->text('description');
            $table->timestamps();
            // $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable(true);
            // $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable(true);

            $table->foreign('status')->references('id')->on('status');
            $table->foreign('empresa')->references('id')->on('empresas');
            $table->foreign('modalidade')->references('id')->on('modalidades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licitacoes');
    }
};
