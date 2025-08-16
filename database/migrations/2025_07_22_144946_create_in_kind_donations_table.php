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
        Schema::create('in_kind_donations', function (Blueprint $table) {
              $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('book')->default(0);
            $table->text('discr_book')->nullable();
            $table->integer('clothes')->default(0);
            $table->text('discr_clothes')->nullable();
            $table->integer('shoes')->default(0);
            $table->text('discr_shoes')->nullable();
            $table->integer('other')->default(0);
            $table->text('discr_other')->nullable();
            $table->string('receipt_image');
            $table->enum('status', ['pending', 'received', 'distributed'])->default('pending');
            $table->timestamp('submitted_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('in_kind_donations');
    }
};
