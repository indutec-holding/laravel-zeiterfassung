<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeeToTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('times', function (Blueprint $table) {
            $table->string('personalnummer');
            $table->longblob('start_foto');
            $table->longblob('end_foto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('times', function (Blueprint $table) {
            //
        });
    }
}
