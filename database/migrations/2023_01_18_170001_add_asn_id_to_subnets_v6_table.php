<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Jeoip\Ip2Location\Models\Asn;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jeoip_ip2location_subnets_v6', function (Blueprint $table) {
            $table->foreignIdFor(Asn::class, 'asn_id')
                ->after('location_id')
                ->nullable()
                ->constrained('jeoip_ip2location_asn')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jeoip_ip2location_subnets_v6', function ($table) {
            $table->dropColumn('asn_id');
        });
    }
};
