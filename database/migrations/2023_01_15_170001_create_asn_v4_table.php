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
        Schema::create('jeoip_ip2location_asn_v4', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedInteger('network_start');
            $table->unsignedInteger('network_end');
            $table->string('cidr', 18);
            $table->integer('asn');
            $table->string('title');
            $table->timestamps();

            $table->index(['network_start', 'network_end']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jeoip_ip2location_asn_v4');
    }
};
