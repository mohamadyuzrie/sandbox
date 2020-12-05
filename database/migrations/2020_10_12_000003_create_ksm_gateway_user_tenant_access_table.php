<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKsmGatewayUserTenantAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('ksm-gateway')->hasTable('user_tenant_acccess')) {
            Schema::connection('ksm-gateway')->create('user_tenant_acccess', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id')->unsigned();
                $table->integer('tenant_id')->unsigned();
                $table->timestamps();
            });

            DB::connection('ksm-gateway')->table('user_tenant_acccess')->insert([
                [
                    'user_id' => 1,
                    'tenant_id' => 1,
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
        if (!Schema::connection('ksm-gateway')->hasTable('user_tenant_acccess')) {
            Schema::connection('ksm-gateway')->dropIfExists('user_tenant_acccess');
        }
    }
}
