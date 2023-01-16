<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Jeoip\Ip2Location\Models\Asn;
use Jeoip\Ip2Location\Models\Location;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jeoip_ip2location_subnets_v4', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('network_start');
            $table->unsignedInteger('network_end');
            $table->foreignIdFor(Location::class, 'location_id')
                ->constrained('jeoip_ip2location_locations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Asn::class, 'asn_id')
                ->nullable()
                ->constrained('jeoip_ip2location_asn')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('cidr', 18);
            $table->index(['network_start', 'network_end']);
            $table->unique('network_start');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jeoip_ip2location_subnets_v4');
    }
};
