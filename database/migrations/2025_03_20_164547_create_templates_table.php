<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id(); // int(11) auto increment
            $table->unsignedBigInteger('user_id');
            $table->string('name', 255);
            $table->string('file_path', 255)->nullable();
            $table->longText('layout_storage')->nullable();

            $table->timestamps(); // created_at & updated_at otomatis

            // Foreign key opsional
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
    }
}
