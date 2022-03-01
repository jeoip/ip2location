<?php

namespace Jeoip\Ip2Location\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jeoip\Common\Utilities;
use Jeoip\Contracts\ICidr;
use Jeoip\Ip2Location\Casts\CidrCast;

/**
 * @property ICidr $cidr It's for a known issue nunomaduro/larastan#890
 */
class SubnetV6 extends Model
{
    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    public static function fromIP(string $ip): ?self
    {
        $decimal = Utilities::ipToDec($ip);

        /**
         * @var self|null
         */
        $result = self::query()
            ->where('network_start', '<=', $decimal)
            ->where('network_end', '>', $decimal)
            ->first();

        return $result;
    }

    /**
     * @var string
     */
    protected $table = 'jeoip_ip2location_subnets_v6';

    /**
     * @var string[]
     */
    protected $fillable = [
        'network_start',
        'network_end',
        'cidr',
        'location_id',
    ];

    /**
     * @var array<string,string>
     */
    protected $casts = [
        'network_start' => 'decimal:39',
        'network_end' => 'decimal:39',
        'cidr' => CidrCast::class,
    ];

    /**
     * @return BelongsTo<Location,self>
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
