<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up()
    {
        Schema::create('jeoip_ip2location_asn', function (Blueprint $table) {
            $table->unsignedInteger('id', true);
            $table->string('title');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jeoip_ip2location_asn');
    }
};
