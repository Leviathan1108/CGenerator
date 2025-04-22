<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientsTable extends Migration
{
    public function up()
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Pastikan menggunakan engine InnoDB
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipients');
    }
}
