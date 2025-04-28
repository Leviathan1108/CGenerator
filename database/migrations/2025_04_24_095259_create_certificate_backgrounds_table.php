<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('certificate_backgrounds', function (Blueprint $table) {
        $table->id();
        $table->string('file_path');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('certificate_backgrounds');
}
}
