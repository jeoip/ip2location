<?php

namespace Jeoip\Ip2Location\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jeoip\Ip2Location\Database\Factories\AsnFactory;

class Asn extends Model
{
    use HasFactory;
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    /**
     * @var string
     */
    protected $table = 'jeoip_ip2location_asn';

    protected static function newFactory()
    {
        return AsnFactory::new();
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
    ];
}
