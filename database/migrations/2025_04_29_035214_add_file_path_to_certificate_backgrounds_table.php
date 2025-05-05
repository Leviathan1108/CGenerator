<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilePathToCertificateBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('certificate_backgrounds', function (Blueprint $table) {
        if (!Schema::hasColumn('certificate_backgrounds', 'file_path')) {
            $table->string('file_path')->after('id');
        }
    });
}


public function down()
{
    Schema::table('certificate_backgrounds', function (Blueprint $table) {
        $table->dropColumn('file_path');
    });
}
}
