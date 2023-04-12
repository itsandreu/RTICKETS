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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->nullable()->constrained('users')->onDelete('set null')->onUpdate('set null');
            $table->foreignId('asignado')->nullable()->constrained('users')->onDelete('set null')->onUpdate('set null');
            $table->string('titulo');
            $table->text('descripcion');
            $table->foreignId('id_estado')->nullable()->constrained('estados')->onDelete('set null')->onUpdate('set null');
            $table->foreignId('id_prioridad')->nullable()->constrained('prioridades')->onDelete('set null')->onUpdate('set null');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
