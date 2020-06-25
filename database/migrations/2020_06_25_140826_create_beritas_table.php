<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ini_set('memory_limit', '-1');
        if (env("APP_DEBUG", true)) {
            DB::unprepared(file_get_contents("database/migrations/dump.sql"));
        }
        DB::statement("ALTER TABLE berita ADD FULLTEXT search(judul,deskripsi,tag)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beritas');
    }
}