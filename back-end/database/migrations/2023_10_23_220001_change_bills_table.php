<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->integer('total_amount')->change();
        });
    }
};
