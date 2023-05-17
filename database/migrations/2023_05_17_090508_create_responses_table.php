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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->enum('reply_under_process', ["Y", "N"])->default('N');
            $table->enum('awaited_reply_under_process', ["Y", "N"])->default('N');
            $table->enum('docs_verification_under_process', ["Y", "N"])->default('N');
            $table->enum('info_awaited', ["Y", "N"])->default('N');
            $table->integer('product_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
