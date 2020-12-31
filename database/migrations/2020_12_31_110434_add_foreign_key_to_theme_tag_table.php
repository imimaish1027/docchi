<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToThemeTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('theme_tag', function (Blueprint $table) {
            $table->foreign('theme_id')->references('id')->on('themes');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('theme_tag', function (Blueprint $table) {
            $table->dropForeign('theme_tag_theme_id_foreign');
            $table->dropForeign('theme_tag_tag_id_foreign');
        });
    }
}
