<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsLetterContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_letter_contents', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('content');
            $table->string('from_name');
            $table->string('from_email');
            $table->integer('total')->default(0);
            $table->integer('queue')->default(0);
            $table->integer('sent')->default(0);
            $table->integer('failed')->default(0);
            $table->boolean('publish')->default(0)->comment('0 -> draft, newsletter tidak dikirim; 1 -> publish, masuk ke antrian jalannya cron');
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
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
        Schema::dropIfExists('news_letter_contents');
    }
}
