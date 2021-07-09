<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AttendanceUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkinout', function (Blueprint $table) {
            $table->boolean('is_pushed')->default(0);
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('created_at')->nullable();
         ;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkinout', function (Blueprint $table) {

        });
    }
}
