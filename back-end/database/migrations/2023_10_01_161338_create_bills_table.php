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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->text('description');
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->integer('discount')->nullable();
            $table->float('total_amount');
            $table->integer('transaction_type');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->unsignedBigInteger('prescription_id')->nullable();
            $table->unsignedBigInteger('promotion_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('appointment_id')->references('id')->on('appointments');
            $table->foreign('prescription_id')->references('id')->on('prescriptions');
            $table->foreign('promotion_id')->references('id')->on('promotions');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
