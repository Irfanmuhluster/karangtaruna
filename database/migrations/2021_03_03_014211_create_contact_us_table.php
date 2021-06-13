<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('name', 225);
            $table->string('email', 225);
            $table->string('address', 225);
            $table->string('city', 225)->nullable();
            $table->string('province', 225)->nullable();
            $table->string('phone', 225)->nullable();
            $table->text('message')->nullable();
            $table->text('reply_msg')->nullable();
            $table->text('reply')->nullable();
            $table->tinyInteger('is_reply')->default('0');
            $table->text('image')->nullable();
            $table->string('status')->default('0');
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
        Schema::dropIfExists('contact_us');
    }
}
