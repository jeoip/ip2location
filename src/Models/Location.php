<?php

namespace Jeoip\Ip2Location\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * @var string
     */
    protected $table = 'jeoip_ip2location_locations';

    /**
     * @var string[]
     */
    protected $fillable = [
        'countryCode',
        'country',
        'region',
        'city',
        'latitude',
        'longitude',
        'zipcode',
        'timezone',
    ];
}
