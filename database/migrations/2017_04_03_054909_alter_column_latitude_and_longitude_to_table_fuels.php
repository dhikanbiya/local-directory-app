<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnLatitudeAndLongitudeToTableFuels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fuels', function (Blueprint $table) {
            $table->string('lat')->after('fuel_type');            
            $table->string('lng')->after('lat');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
         Schema::table('fuels', function (Blueprint $table) {
          $table->dropColumn(['lat','lng']);
      });
    }
}
