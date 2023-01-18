<?php

namespace Jeoip\Ip2Location\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jeoip\Ip2Location\Database\Factories\AsnV4Factory;

class AsnV4 extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'jeoip_ip2location_asn_v4';

    protected static function newFactory()
    {
        return AsnV4Factory::new();
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'network_start',
        'network_end',
        'cidr',
        'title',
    ];
}
