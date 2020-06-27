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
        if (env("IS_DOCKER", false)) {
            DB::unprepared(file_get_contents("database/migrations/dump.sql"));
        }
        DB::statement("ALTER TABLE berita ADD COLUMN id INT AUTO_INCREMENT UNIQUE FIRST");
        DB::statement("ALTER TABLE berita ADD COLUMN click bigint DEFAULT 0");
        DB::statement("ALTER TABLE berita ADD FULLTEXT search(judul,deskripsi,tag)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropColumn('click');
        });
        DB::statement("ALTER TABLE berita DROP INDEX search");
        // Schema::dropIfExists('berita');
    }
}