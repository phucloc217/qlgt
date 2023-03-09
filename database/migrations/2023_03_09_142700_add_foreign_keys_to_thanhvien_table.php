<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thanhvien', function (Blueprint $table) {
            $table->foreign(['giaoho'], 'thanhvien_ibfk_1')->references(['id'])->on('giaoho')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thanhvien', function (Blueprint $table) {
            $table->dropForeign('thanhvien_ibfk_1');
        });
    }
};
