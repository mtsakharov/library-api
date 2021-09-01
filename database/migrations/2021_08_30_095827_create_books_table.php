<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cover');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('librarian_id');
            $table->timestamps();
            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onDelete('CASCADE');
            $table->foreign('librarian_id')
                ->references('id')
                ->on('librarians')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
