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
        Schema::table('thanhvien_diemdanh', function (Blueprint $table) {
            $table->foreign(['nguoidiemdanh'], 'thanhvien_diemdanh_ibfk_3')->references(['id'])->on('users')->onUpdate('SET NULL')->onDelete('SET NULL');
            $table->foreign(['madiemdanh'], 'thanhvien_diemdanh_ibfk_2')->references(['id'])->on('diemdanh')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['mathanhvien'], 'thanhvien_diemdanh_ibfk_1')->references(['ma'])->on('thanhvien')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thanhvien_diemdanh', function (Blueprint $table) {
            $table->dropForeign('thanhvien_diemdanh_ibfk_3');
            $table->dropForeign('thanhvien_diemdanh_ibfk_2');
            $table->dropForeign('thanhvien_diemdanh_ibfk_1');
        });
    }
};
