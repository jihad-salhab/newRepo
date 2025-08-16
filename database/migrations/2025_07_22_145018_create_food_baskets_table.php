<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_baskets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donor_id');
            $table->unsignedBigInteger('beneficiary_id')->nullable();
            $table->integer('quantity');
            $table->enum('status', ['approved', 'delivered'])->default('approved');
            $table->timestamp('request_date');
            $table->timestamp('delivery_date')->nullable();
            $table->timestamps();

            $table->foreign('donor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('beneficiary_id')->references('id')->on('beneficiaries')->onDelete('set null');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_baskets');
    }
};
