<?php

namespace Jeoip\Ip2Location\Console\Commands;

use Illuminate\Console\Command;
use Jeoip\Common\Exceptions\Exception;
use Jeoip\Ip2Location\Models\Asn;
use Jeoip\Ip2Location\Models\AsnV4;
use Jeoip\Ip2Location\Models\AsnV6;
use SplFileObject;

/**
 * @phpstan-type CsvData array{
 * 		network_start:string,
 * 		network_end:string,
 * 		cidr:string,
 * 		asn:integer,
 * 		title:string,
 * 	}
 */
class ImportAsn extends Command
{
    /**
     * @var string
     */
    protected $signature = 'jeoip:ip2location:import:asn
		{--ipv=}
		{file}';

    /**
     * @var string
     */
    protected $description = 'Import asn into database';

    public function handle(): void
    {
        $file = $this->argument('file');
        if (!is_string($file) or !is_file($file)) {
            throw new Exception('{file} is not valid file');
        }

        $ipv = intval($this->option('ipv'));
        if (!in_array($ipv, [4, 6])) {
            throw new Exception('--ipv must be 4 or 6');
        }

        $model = 4 == $ipv ? AsnV4::class : AsnV6::class;

        $fd = new SplFileObject($file, 'r');
        while (!$fd->eof()) {
            $row = $fd->fgetcsv();
            if (!$row) {
                continue;
            }

            $row = $this->parseCsv($row);
            if ('-' == $row['asn']) {
                continue;
            }

            $this->save($model, $row);
        }
    }

    /**
     * @param array<string> $data
     *
     * @return CsvData
     */
    protected function parseCsv(array $data)
    {
        $columns = [
            'network_start',
            'network_end',
            'cidr',
            'asn',
            'title',
        ];

        $count = count($data);
        if ($count != count($columns)) {
            throw new Exception('Csv data is not supported');
        }

        $data = array_combine($columns, $data);

        /*
         * @var CsvData
         */
        return $data;
    }

    /**
     * @param class-string<AsnV4|AsnV6> $model
     * @param CsvData                   $data
     *
     * @return AsnV4|AsnV6
     */
    protected function save($model, array $data)
    {
        $asn = Asn::query()->updateOrCreate(['id' => $data['asn']], ['title' => $data['title']]);
        return $model::query()->updateOrCreate(
            [
                'network_start' => $data['network_start'],
                'network_end' => $data['network_end'],
            ],
            [
                'cidr' => $data['cidr'],
                'asn_id' => $asn->id,
            ]
        );
    }
}
