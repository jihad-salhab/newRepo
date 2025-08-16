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
        Schema::create('wallet_transactions', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('wallet_id');
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['top_up', 'donation', 'refund']);
            $table->text('description');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
