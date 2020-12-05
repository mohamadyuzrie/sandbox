<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKsmGatewayTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('ksm-gateway')->hasTable('tenants')) {
            Schema::connection('ksm-gateway')->create('tenants', function (Blueprint $table) {
                $table->id();
                $table->integer('app_id')->unsigned()->comment('these databases are used in this app');
                $table->string('name')->nullable()->comment('e.g.: Kusimi Webacc');
                $table->string('description')->nullable()->comment('e.g.: Period: 012019-122019');
                $table->string('db_database')->nullable()->comment('e.g.: ksm_account');
                $table->string('db_username')->nullable()->comment('e.g.: ksm_dbuser');
                $table->string('db_password')->nullable()->comment('e.g.: md5(\'123456\')');
                $table->timestamps();
            });

            DB::connection('ksm-gateway')->table('tenants')->insert([
                [
                    'app_id' => 1,
                    'name' => 'Kusimi Cloud Account 2020',
                    'description' => 'Period: 012020-122020',
                    'db_database' => 'ksm_account',
                    'db_username' => 'admin',
                    'db_password' => bcrypt('123456'),
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
        if (!Schema::connection('ksm-gateway')->hasTable('tenants')) {
            Schema::connection('ksm-gateway')->dropIfExists('tenants');
        }
    }
}
