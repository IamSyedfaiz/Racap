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
        Schema::create('calender_alerts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('particular')->nullable();
            $table->string('renew_date')->nullable();
            $table->string('alert_date1')->nullable();
            $table->string('alert_date2')->nullable();
            $table->string('alert_date3')->nullable();
            $table->string('alert_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calender_alerts');
    }
};
