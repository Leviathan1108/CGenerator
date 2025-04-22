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
            $table->engine = 'InnoDB'; // Pastikan menggunakan engine InnoDB
    $table->id();
    $table->foreignId('template_id')->constrained()->onDelete('cascade'); // Relasi ke templates
    $table->foreignId('recipient_id')->constrained()->onDelete('cascade'); // Relasi ke recipients
    $table->string('uid', 100)->unique();
    $table->string('verification_code', 100)->unique();
    $table->timestamp('issued_date')->default(now());
    $table->enum('status', ['draft', 'published', 'revoked'])->default('draft');
    $table->timestamps();
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
