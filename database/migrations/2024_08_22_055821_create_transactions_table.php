<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->string('transaction_type');
            $table->decimal('amount', 15, 2);
            $table->date('date');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->unsignedBigInteger('target_account_id')->nullable();
            $table->timestamps();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('target_account_id')->references('id')->on('accounts')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropForeign(['target_account_id']);
        });
        Schema::dropIfExists('transactions');
    }
};
