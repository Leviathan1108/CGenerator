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
    {Schema::create('certificates', function (Blueprint $table) {
        $table->id();
        $table->foreignId('selected_template_id')->nullable()->constrained('templates')->nullOnDelete();
        $table->foreignId('contact_id')->nullable()->constrained('contacts')->nullOnDelete();
    
        $table->string('uid', 100);
        $table->string('verification_code', 100);
        $table->timestamp('issued_date')->useCurrent();
    
        $table->enum('status', ['draft', 'published', 'revoked'])->default('draft');
        $table->enum('background_choice', ['custom', 'template'])->nullable();
    
        $table->string('event_name')->nullable();
        $table->string('logo_path')->nullable();
        $table->string('file_path')->nullable();
    
        $table->string('title')->nullable();
        $table->string('role')->nullable();
        $table->string('certificate_type', 100)->nullable();
        $table->date('date')->nullable();
        $table->text('description')->nullable();
    
        $table->string('signature_path')->nullable();
        $table->string('signature_name')->nullable();
    
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
