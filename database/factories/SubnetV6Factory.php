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
            'network_start' => 281470698520576,
            'network_end' => 281470698520831,
            'location' => Location::class,
            'cidr' => '::ffff:1.0.0.0/118',
        ];
    }
}
