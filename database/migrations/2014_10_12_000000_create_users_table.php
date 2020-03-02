<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            /*
             * 1.superuser
             * 2.admin
             * 3.professor
             * 4.students
             */
            $table->unsignedTinyInteger('type');
            $table->rememberToken();
            $table->timestamps();
        });


        \App\User::create(['name' => 'محسن میرحسینی', 'username' => 'nishtman', 'email' => 'mohsen.mirhosseini@gmail.com', 'password' => Hash::make('Nil00f@r1869'), 'type' => 1]);
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
