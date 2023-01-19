<?php

namespace Jeoip\Ip2Location\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jeoip\Ip2Location\Database\Factories\LocationFactory;

class Location extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'jeoip_ip2location_locations';

    protected static function newFactory()
    {
        return LocationFactory::new();
    }

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
