<?php

namespace Jeoip\Ip2Location\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jeoip\Common\Exceptions\QueryException;
use Jeoip\Contracts\ICidr;
use Jeoip\Ip2Location\Casts\CidrCast;
use Jeoip\Ip2Location\Database\Factories\SubnetV4Factory;

/**
 * @property ICidr $cidr It's for a known issue nunomaduro/larastan#890
 */
class SubnetV4 extends Model
{
    use HasFactory;

    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    protected static function newFactory()
    {
        return SubnetV4Factory::new();
    }

    public static function fromIP(string $ip): ?self
    {
        $decimal = ip2long($ip);
        if (false === $decimal) {
            throw new QueryException('IP is invalid', $ip);
        }

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
    protected $table = 'jeoip_ip2location_subnets_v4';

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
        'cidr' => CidrCast::class,
    ];

    /**
     * @return BelongsTo<Location,self>
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * @return BelongsTo<Asn,self>
     */
    public function asn(): BelongsTo
    {
        return $this->belongsTo(Asn::class);
    }
}
