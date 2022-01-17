<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('active');
            $table->string('name');
            $table->string('address');
            $table->string('number');
            $table->string('complement')->nullable();
            $table->string('cep');
            $table->string('state');
            $table->string('city');
            $table->string('bairro');
            $table->string('country')->nullable();
            $table->string('cnpj');
            $table->string('insc');
            $table->string('phone');
            $table->string('email');  
            $table->text('description')->nullable();          
            $table->string('image', 100)->nullable();
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
