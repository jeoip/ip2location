<?php

namespace Jeoip\Ip2Location\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jeoip\Ip2Location\Models\AsnV4;

class AsnV4Factory extends Factory
{
    protected $model = AsnV4::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 13335,
            'network_start' => 16777216,
            'network_end' => 16777471,
            'cidr' => '1.0.0.0/22',
            'title' => 'CloudFlare Inc.',
        ];
    }
}
