<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKsmGatewayAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('ksm-gateway')->hasTable('apps')) {
            Schema::connection('ksm-gateway')->create('apps', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('name');
                $table->string('cipher')->nullable(); // this should match the app APP_KEY cipher key so that we can use Crypt::encryptString($string) and Crypt::decryptString($string)
                $table->string('link')->nullable()->comment('for reference only so we know which repository this app come from');
                $table->timestamps();
            });

            DB::connection('ksm-gateway')->table('apps')->insert([
                [
                    'code' => 'KCA2020',
                    'name' => 'Kusimi Cloud Account',
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
        if (!Schema::connection('ksm-gateway')->hasTable('apps')) {
            Schema::connection('ksm-gateway')->dropIfExists('apps');
        }
    }
}
