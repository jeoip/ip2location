<?php

namespace Jeoip\Ip2Location\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jeoip\Ip2Location\Database\Factories\AsnV6Factory;

class AsnV6 extends Model
{
    use HasFactory;
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    /**
     * @var string
     */
    protected $table = 'jeoip_ip2location_asn_v6';

    protected static function newFactory()
    {
        return AsnV6Factory::new();
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'network_start',
        'network_end',
        'cidr',
        'asn_id',
    ];

    public function asn(): BelongsTo
    {
        return $this->belongsTo(Asn::class);
    }
}
