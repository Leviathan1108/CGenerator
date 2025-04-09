<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientsTable extends Migration
{
    public function up()
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->id(); // Primary key "id"
            $table->foreignId('certificate_id')->constrained('certificates')->onDelete('cascade'); // Foreign key
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamps(); // Menambahkan created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipients');
    }
}
