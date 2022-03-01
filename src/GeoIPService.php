<?php

namespace Jeoip\Ip2Location;

use Jeoip\Common\Exceptions\QueryException;
use Jeoip\Common\Exceptions\UnknownLocationException;
use Jeoip\Common\Utilities;
use Jeoip\Contracts\IGeoIPService;
use Jeoip\Ip2Location\Models\SubnetV4;
use Jeoip\Ip2Location\Models\SubnetV6;

class GeoIPService implements IGeoIPService
{
    public function query(string $ip): Location
    {
        if (!Utilities::isIp($ip)) {
            throw new QueryException("It's not valid ip", $ip);
        }

        if (Utilities::isIpv4($ip)) {
            return $this->queryIPv4($ip);
        }

        return $this->queryIPv6($ip);
    }

    public function queryIPv4(string $ipv4): Location
    {
        $subnet = SubnetV4::fromIP($ipv4);
        if (!$subnet) {
            throw new UnknownLocationException($ipv4);
        }

        return Location::fromSubnet($subnet);
    }

    public function queryIPv6(string $ipv6): Location
    {
        $subnet = SubnetV6::fromIP($ipv6);
        if (!$subnet) {
            throw new UnknownLocationException($ipv6);
        }

        return Location::fromSubnet($subnet);
    }
}
