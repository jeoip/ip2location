<?php

namespace Jeoip\Ip2Location\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jeoip\Ip2Location\Models\Location;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'countryCode' => 'US',
            'country' => 'United States of America',
            'region' => 'California',
            'city' => 'Los Angeles',
            'latitude' => 34.052859,
            'longitude' => -118.24357,
            'zipcode' => '90001',
            'timezode' => '-08:00',
        ];
    }
}
