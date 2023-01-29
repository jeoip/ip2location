<?php

namespace Jeoip\Ip2Location\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Jeoip\Common\Cidr;
use Jeoip\Contracts\ICidr;

class CidrCast implements CastsAttributes
{
    /**
     * @param array<string,mixed> $attributes
     */
    public function get($model, string $key, $value, array $attributes): Cidr
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('The given value is not a string.');
        }

        return Cidr::parse($value);
    }

    /**
     * @param ICidr               $value
     * @param array<string,mixed> $attributes
     */
    public function set($model, string $key, $value, array $attributes): string
    {
        if (!$value instanceof ICidr) {
            throw new \InvalidArgumentException('The given value is not a Cidr instance.');
        }

        return $value->__toString();
    }
}
