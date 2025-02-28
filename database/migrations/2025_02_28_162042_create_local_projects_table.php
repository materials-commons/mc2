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
        Schema::create('local_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('local_path')->nullable();
            $table->unsignedBigInteger('remote_id')->nullable();
            $table->text('notes')->nullable();
            $table->datetime('last_synced_at')->nullable();
            $table->datetime('remote_last_synced_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_projects');
    }
};
