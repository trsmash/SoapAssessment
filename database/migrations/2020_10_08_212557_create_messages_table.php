<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('channel_id');
            $table->unsignedBigInteger('sent_by_id');
            $table->mediumText('text');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('channel_id')->references('id')->on('workspace_channels');
            $table->foreign('sent_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
           $table->dropForeign('messages_channel_id_foreign');
           $table->dropForeign('messages_sent_by_id_foreign');
        });
        Schema::dropIfExists('messages');
    }
}
