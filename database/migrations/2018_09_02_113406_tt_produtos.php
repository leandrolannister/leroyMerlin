<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TtProdutos extends Migration
{
    public function up()
    {
      Schema::create('tt_produtos', function (Blueprint $table) {
        $table->increments('id');
        $table->string('item');
        $table->string('name');
        $table->string('description');
        $table->integer('free_shipping');
        $table->decimal('price');
        $table->timestamps();
      });      
    }

    public function down()
    {
      Schema::drop("tt_produtos");    
    }
}
