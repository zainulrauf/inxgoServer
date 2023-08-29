<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('title')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('ticket_type_id')->nullable();
            $table->foreign('ticket_type_id')->references('id')->on('ticket_type')->onDelete('cascade');
            $table->unsignedBigInteger('ticket_status_id')->nullable();
            $table->foreign('ticket_status_id')->references('id')->on('ticket_status')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('image')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
