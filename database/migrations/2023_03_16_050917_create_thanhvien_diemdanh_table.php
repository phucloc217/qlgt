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
        Schema::create('thanhvien_diemdanh', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('mathanhvien')->index('ctddmatv');
            $table->integer('madiemdanh')->index('ccddmadd');
            $table->unsignedBigInteger('nguoidiemdanh')->nullable()->index('nguoidiemdanh');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thanhvien_diemdanh');
    }
};
