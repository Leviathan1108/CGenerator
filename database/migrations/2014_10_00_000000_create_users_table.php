<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('custom_id')->unique(); // custom ID seperti USR-2025-001
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('role', ['superadmin', 'admin', 'recipient', 'guest'])->default('guest');
            $table->string('photo_profile')->nullable(); // hanya path, misalnya: "profiles/123.jpg"
            $table->foreignId('subscription_id')->nullable()->constrained('subscriptions');
            $table->unsignedBigInteger('certificate_id')->nullable();
            // $table->foreignId('certificate_id')->nullable()->constrained('certificates')->nullOnDelete();
            // $table->foreign('certificate_id')->references('id')->on('certificates')->onDelete('set null');
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
        Schema::dropIfExists('users');
    }
}
