<?php

namespace Jeoip\Ip2Location\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jeoip\Ip2Location\Models\Asn;

class AsnFactory extends Factory
{
    protected $model = Asn::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 13335,
            'title' => 'CloudFlare Inc.',
        ];
    }
}
