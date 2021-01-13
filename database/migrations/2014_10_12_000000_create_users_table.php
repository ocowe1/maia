<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('tipo');
            $table->string('celular');
            $table->string('token')->default (0);
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        DB::table('users')
            ->insert([
                [
                    'name' => 'Vinicius Costa Santos',
                    'tipo' => 1,
                    'celular' => '13981575072',
                    'email' => 'viniciusath@hotmail.com',
                    'password' => \Illuminate\Support\Facades\Hash::make('Zulo!1999.'),
                ],
                [
                    'name' => 'Vitor Duarte',
                    'tipo' => 2,
                    'celular' => '12981403677',
                    'email' => 'vitorduartefrota@gmail.com',
                    'password' => \Illuminate\Support\Facades\Hash::make('protocolomaia')

                ]
            ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
