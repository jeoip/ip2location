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
        Schema::create('jeoip_ip2location_asn_v6', function (Blueprint $table) {
            $table->id('id');
            $table->decimal('network_start', 39, 0);
            $table->decimal('network_end', 39, 0);
            $table->string('cidr', 39);
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
        Schema::dropIfExists('jeoip_ip2location_asn_v6');
    }
};
