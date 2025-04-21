<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('verification_code')->unique();
            $table->date('issued_date')->nullable();
            $table->enum('status', ['draft', 'published', 'revoked']);
            $table->enum('background_choice', ['custom', 'template']);
            $table->unsignedBigInteger('selected_template_id')->nullable();
            $table->string('event_name');
            $table->string('logo_path')->nullable();
            $table->timestamps();
            $table->foreign('selected_template_id')->references('id')->on('templates')->nullOnDelete();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
