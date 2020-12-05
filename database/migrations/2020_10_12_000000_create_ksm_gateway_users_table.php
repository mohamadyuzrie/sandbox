<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKsmGatewayUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('ksm-gateway')->hasTable('users')) {
            Schema::connection('ksm-gateway')->create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });

            DB::connection('ksm-gateway')->table('users')->insert([
                [
                    'name' => 'System Admin',
                    'username' => 'SA',
                    'email' => 'sa@email.com',
                    'password' => bcrypt('12345678'),
                ]
            ]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::connection('ksm-gateway')->hasTable('users')) {
            Schema::connection('ksm-gateway')->dropIfExists('users');
        }
    }
}
