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
        Schema::create('roles_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id')->constrained(table: 'roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('permission_id')->constrained(table: 'permissions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unique(['rol_id','permission_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_permissions');
    }
};
