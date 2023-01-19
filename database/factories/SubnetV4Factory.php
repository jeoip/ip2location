<?php

namespace Jeoip\Ip2Location\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jeoip\Ip2Location\Models\Location;
use Jeoip\Ip2Location\Models\SubnetV4;

class SubnetV4Factory extends Factory
{
    protected $model = SubnetV4::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'network_start' => 16777216,
            'network_end' => 16777471,
            'location' => Location::class,
            'cidr' => '1.0.0.0/22',
        ];
    }
}
