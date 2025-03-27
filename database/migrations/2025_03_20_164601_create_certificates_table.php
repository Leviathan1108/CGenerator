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
            $table->foreignId('template_id')->constrained('templates')->onDelete('cascade');
            $table->foreignId('recipient_id')->constrained('recipients')->onDelete('cascade');
            $table->foreignId('issued_by')->nullable()->constrained('users')->onDelete('set null');
            $table->date('issue_date')->default(now());
            $table->enum('status', ['draft', 'published', 'revoked'])->default('draft');
            $table->string('verification_code')->unique();
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
