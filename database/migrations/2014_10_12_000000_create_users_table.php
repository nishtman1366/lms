<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_code')->nullable()->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->nullable()->unique();
            $table->timestamps();

            $table->index('first_name');
            $table->index('last_name');
            $table->index('national_code');
            $table->index('username');
        });

        DB::table('users')->insert([
            ['first_name' => 'مدیر', 'last_name' => 'کل', 'national_code' => '1234567890', 'username' => 'nishtman', 'password' => Hash::make('Nil00f@r1869'), 'email' => 'mohsen.mirhoseini@gmail.com']
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
