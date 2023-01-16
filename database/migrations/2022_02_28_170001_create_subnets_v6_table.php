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
        Schema::create('jeoip_ip2location_subnets_v6', function (Blueprint $table) {
            $table->id();

            $table->decimal('network_start', 39, 0);
            $table->decimal('network_end', 39, 0);
            $table->foreignIdFor(Location::class, 'location_id')
                ->constrained('jeoip_ip2location_locations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignIdFor(Asn::class, 'asn_id')
                ->nullable()
                ->constrained('jeoip_ip2location_asn')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('cidr', 39);
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
        Schema::dropIfExists('jeoip_ip2location_subnets_v6');
    }
};
