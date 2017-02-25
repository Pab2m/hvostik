<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	
	public function up()
	{
            Schema::create('users', function ($table){
                $table->increments('id');
                $table->string('email',50)->unique();
                $table->string('password', 128);
                $table->string('remember_token',300);
                $table->boolean('active');
                $table->string('activation_code');
                $table->integer('pravo');
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
