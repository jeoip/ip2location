<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jeoip_ip2location_locations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('countryCode', 2);
            $table->string('country', 64);
            $table->string('region', 128);
            $table->string('city', 128);
            $table->double('latitude');
            $table->double('longitude');
            $table->string('zipcode', 30);
            $table->string('timezone', 8);

            $table->unique(['countryCode', 'region', 'city']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jeoip_ip2location_locations');
    }
};
