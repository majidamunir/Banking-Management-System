<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'account-creation-requested', 'transaction-requested', 'loan-requested'
            $table->text('data'); // Store notification data in JSON format
            $table->foreignId('user_id')->constrained(); // User ID associated with the notification
            $table->boolean('read')->default(false); // Mark as read or unread
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}

