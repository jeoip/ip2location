<?php

namespace Jeoip\Ip2Location\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jeoip\Ip2Location\Models\AsnV6;

class AsnV6Factory extends Factory
{
    protected $model = AsnV6::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 6939,
            'network_start' => 42540488161975842760550356425300246528,
            'network_end' => 42540488241204005274814694018844196863,
            'cidr' => '2001::/32',
            'title' => 'Hurricane Electric LLC',
        ];
    }
}
