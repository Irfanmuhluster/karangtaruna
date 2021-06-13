<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name',225);
            $table->string('email',225);
            $table->string('phone',225);
            $table->text('address',225);
            $table->text('map',225)->nullable();
            $table->tinyInteger('is_name')->default('0');
            $table->tinyInteger('is_email')->default('0');
            $table->tinyInteger('is_address')->default('0');
            $table->tinyInteger('is_city')->default('0');
            $table->tinyInteger('is_phone')->default('0');
            $table->tinyInteger('is_province')->default('0');
            $table->tinyInteger('is_message')->default('0');
            $table->tinyInteger('is_image')->default('0');
            $table->tinyInteger('is_enable')->default('0');
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
        Schema::dropIfExists('contact_us_settings');
    }
}
