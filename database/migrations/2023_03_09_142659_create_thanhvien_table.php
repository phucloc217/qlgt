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
        Schema::create('thanhvien', function (Blueprint $table) {
            $table->integer('ma')->primary();
            $table->string('tenthanh', 30);
            $table->string('hoten', 50);
            $table->timestamp('ngaysinh')->nullable();
            $table->string('hotencha', 60)->nullable();
            $table->string('hotenme', 60)->nullable();
            $table->string('diachi')->nullable();
            $table->text('ghichu')->nullable();
            $table->char('sdt', 10)->nullable();
            $table->integer('giaoho')->default(1)->index('giaoho');
            $table->boolean('giaoly')->default(true);
            $table->string('matkhau');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('trangthai')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thanhvien');
    }
};
