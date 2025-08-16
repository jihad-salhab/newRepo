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
        Schema::create('orphans', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('full_name');
            $table->string('symbolic_name');
            $table->integer('age');
            $table->string('city');
            $table->string('avatar');
            $table->boolean('is_sponsored')->default(false);
            $table->string('father_death_cert');
            $table->boolean('mother_death');
            $table->string('mother_death_cert')->nullable();
            $table->decimal('monthly_cost', 10, 2);
            $table->text('address');
            $table->string('relative_phone');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->integer('max_sponsorship_months');
            $table->timestamp('approved_at')->nullable();
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
        Schema::dropIfExists('orphans');
    }
};
