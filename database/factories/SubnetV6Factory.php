<?php

namespace Jeoip\Ip2Location\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jeoip\Ip2Location\Models\Location;
use Jeoip\Ip2Location\Models\SubnetV6;

class SubnetV6Factory extends Factory
{
    protected $model = SubnetV6::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'network_start' => 42540488161975842760550356425300246528,
            'network_end' => 42540488241204005274814694018844196863,
            'location' => Location::class,
            'cidr' => '2001::/32',
        ];
    }
}
