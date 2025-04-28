<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('certificate_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('template_id')->nullable(); // ID dari template sertifikat jika ada
            $table->string('certificate_name');
            $table->string('certificate_title');
            $table->date('issue_date');
            $table->string('recipient_name')->nullable();
            $table->string('logo_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificate_details');
    }
};
