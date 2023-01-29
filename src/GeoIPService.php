<?php

namespace Jeoip\Ip2Location;

use Jeoip\Common\Exceptions\QueryException;
use Jeoip\Common\Exceptions\UnknownLocationException;
use Jeoip\Common\Utilities;
use Jeoip\Contracts\IGeoIPService;
use Jeoip\Ip2Location\Models\AsnV4;
use Jeoip\Ip2Location\Models\AsnV6;
use Jeoip\Ip2Location\Models\SubnetV4;
use Jeoip\Ip2Location\Models\SubnetV6;

class GeoIPService implements IGeoIPService
{
    public function query(?string $ip = null): Location
    {
        if (null === $ip) {
            throw new QueryException('ip cannot be null', '');
        }
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

        $longIP = Utilities::ipToDec($ipv4);
        $asNetwork = AsnV4::where('network_start', '<=', $longIP)->where('network_end', '>', $longIP)->first();

        return Location::create($ipv4, $subnet, $asNetwork?->asn);
    }

    public function queryIPv6(string $ipv6): Location
    {
        $subnet = SubnetV6::fromIP($ipv6);
        if (!$subnet) {
            throw new UnknownLocationException($ipv6);
        }

        $longIP = Utilities::ipToDec($ipv6);
        $asNetwork = AsnV6::where('network_start', '<=', $longIP)->where('network_end', '>', $longIP)->first();

        return Location::create($ipv6, $subnet, $asNetwork?->asn);
    }
}
