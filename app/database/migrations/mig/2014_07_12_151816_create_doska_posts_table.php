<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoskaPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	   Schema::create('doska_posts',function($table){
              $table->increments('id');
              $table->integer('id_user');
              $table->integer('id_city');
              $table->integer('id_kategori');
              $table->integer('id_type');
              $table->integer('id_porodatovari');
              $table->string('title', 250);
              $table->string('img', 250);
              $table->string('name', 50);
              $table->string('phone', 50);
              $table->text('post_text');
              $table->integer('vip_type');
              $table->integer('price');
              $table->integer('sost');
              $table->timestamps();
               
           });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
