<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('users', function (Blueprint $table) {           
           $table->tinyInteger('profile_id')->nullable()->after('password');
           $table->string('api_token', 255)->after('profile_id');
           $table->tinyInteger('active')->default(0)->after('api_token');           
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('users', function (Blueprint $table) {
           $table->dropColumn(['profile_id', 'api_token','active']);
       });
    }
}
