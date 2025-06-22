<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layouts', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel templates
            $table->foreignId('template_id')
                  ->constrained('templates')
                  ->onDelete('cascade'); // Hapus layout jika templatenya dihapus

            // Menyimpan data JSON dari canvas.toJSON()
            $table->longText('layout'); // Gunakan longText untuk JSON besar dari Fabric.js

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layouts');
    }
}
