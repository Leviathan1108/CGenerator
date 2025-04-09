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
        $table->id();
        $table->string('name');
        $table->string('file_path');
        $table->unsignedBigInteger('created_by');
        $table->json('layout_storage')->nullable();
        $table->timestamps();
    
        $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
