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
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->after('id')->default('1');
            // abbiamo aggiunto alla tabella posts una colonna con questo nome
            // con after gli diciamo in che posizione va inserita nel db
            $table->foreign('category_id')->references('id')->on('categories');
            // qui definiamo che category_id è una chiave esterna e definiamo a quale tabella è associata
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // eliminare la chiave esterna
            $table->dropForeign('posts_category_id_foreign');
            // eliminare la colonna
            $table->dropColumn('category_id');
        });
    }
};
