<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up()
    {
        Schema::create('jeoip_ip2location_asn_v6', function (Blueprint $table) {
            $table->decimal('network_start', 39, 0);
            $table->decimal('network_end', 39, 0);
            $table->string('cidr', 39);
            $table->unsignedInteger('asn_id')
                ->nullable();

            $table->index(['network_start', 'network_end']);
            $table->unique('network_start');
            $table->foreign('asn_id')
                ->references('id')
                ->on('jeoip_ip2location_asn')
                ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jeoip_ip2location_asn_v6');
    }
};
