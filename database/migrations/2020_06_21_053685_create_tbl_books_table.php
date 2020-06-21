<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_books', function (Blueprint $table) {
            $table->bigIncrements('idx');
            $table->bigInteger('book_uniq_idx')->unique();
            $table->string('bookname', 255);
            $table->string('cover_photo', 255);
            $table->unsignedBigInteger('co_id');
            $table->foreign('co_id')->references('idx')->on('content_owners');
            $table->unsignedBigInteger('publisher_id');
            $table->foreign('publisher_id')->references('idx')->on('publishers');
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
        Schema::dropIfExists('tbl_books');
    }
}
