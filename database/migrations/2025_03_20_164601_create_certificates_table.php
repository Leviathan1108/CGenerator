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
            $table->id(); // Primary Key
            $table->foreignId('template_id')->constrained('templates')->onDelete('cascade'); // Relasi ke templates
            $table->foreignId('recipient_id')->constrained('recipients')->onDelete('cascade'); // Relasi ke recipients
            $table->string('uid', 100)->unique(); // UID unik
            $table->string('verification_code', 100)->unique(); // Kode verifikasi unik
            $table->timestamp('issued_date')->default(now()); // Tanggal penerbitan
            $table->enum('status', ['draft', 'published', 'revoked'])->default('draft'); // Status
            $table->timestamps(); // created_at & updated_at otomatis
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
