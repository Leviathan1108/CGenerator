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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->string('name'); // Nama template
            // $table->string('recipient'); // Tambahkan kolom recipient di sini
            $table->string('file_path')->nullable(); // hanya path, misalnya: "profiles/123.jpg"
            $table->longText('layout_storage')->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->text('type')->nullable();
            $table->text('background_image_url')->nullable();
            $table->timestamps(); // created_at & updated_at
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
