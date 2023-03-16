<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giaoho', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('tengiaoho', 50);
        });
        DB::table('giaoho')->insert(
            array(
                'id' => 1,
                'tengiaoho' => 'Truyền Tin'
            )
        );
        DB::table('giaoho')->insert(
            array(
                'id' => 2,
                'tengiaoho' => 'Vô Nhiễm'
            )
        );
        DB::table('giaoho')->insert(
            array(
                'id' => 3,
                'tengiaoho' => 'Mẹ Thiên Chúa'
            )
        );
        DB::table('giaoho')->insert(
            array(
                'id' => 4,
                'tengiaoho' => 'Fatima'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('giaoho');
    }
};
