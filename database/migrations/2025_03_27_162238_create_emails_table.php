<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id(); // Primary Key (Auto Increment)
            $table->foreignId('certificate_id')->constrained('certificates')->onDelete('cascade'); // Foreign Key ke Certificates
            $table->foreignId('recipient_id')->constrained('recipients')->onDelete('cascade'); // Foreign Key ke Recipients
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending'); // Status email
            $table->text('error_message')->nullable(); // Pesan error jika gagal
            $table->integer('retry_count')->default(0); // Jumlah percobaan ulang
            $table->timestamp('sent_at')->useCurrent(); // Waktu pengiriman
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
