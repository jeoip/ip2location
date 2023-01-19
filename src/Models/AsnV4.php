<?php

namespace Jeoip\Ip2Location\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jeoip\Ip2Location\Database\Factories\AsnV4Factory;

class AsnV4 extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;

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
        'network_start',
        'network_end',
        'cidr',
        'asn_id',
    ];

    public function asn(): BelongsTo {
        return $this->belongsTo(Asn::class);
    }
}
