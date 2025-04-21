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
        $table->id(); // sama dengan int(11) NOT NULL auto increment
        $table->unsignedBigInteger('selected_template_id')->nullable();
        $table->unsignedBigInteger('user_id')->nullable();
        $table->string('uid', 100);
        $table->string('verification_code', 100);
        $table->timestamp('issued_date')->useCurrent();
        $table->enum('status', ['draft', 'published', 'revoked'])->default('draft');
        $table->enum('background_choice', ['custom', 'template'])->nullable();
        $table->string('event_name', 255)->nullable();
        $table->string('logo_path', 255)->nullable();
        $table->timestamps(); // ini set created_at dan updated_at secara otomatis
        // Foreign key ada relasi
        $table->foreign('selected_template_id')->references('id')->on('templates')->onDelete('set null');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
