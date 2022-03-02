<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category', 100);
        });
    }

    /**
     * Reverse the migrations.
     * (Qdo precisar apagar campos de uma dada tabela)
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //Conteúdo da aula 12
            //Escreve-se: $table->dropColumn('nome_do_campo');
            //No terminal: php artisan migrate:rollback
            //Caso queira apagar todas as migrates: php artisan migrate:reset
            //Para criar: php artisan migrate
            //... : php artisan migrate:refresh
            //... : php artisan migrate:fresh
            $table->dropColumn('category');
        });
    }
}
