<?php

namespace Jeoip\Ip2Location\Console\Commands;

use Illuminate\Console\Command;
use Jeoip\Common\Cidr;
use Jeoip\Common\Exceptions\Exception;
use Jeoip\Ip2Location\Models\Location;
use Jeoip\Ip2Location\Models\SubnetV4;
use Jeoip\Ip2Location\Models\SubnetV6;

/**
 * @phpstan-type CsvData array{
 * 		network_start:string,
 * 		network_end:string,
 * 		countryCode:string,
 * 		country:string,
 * 		region:string,
 * 		city:string,
 * 		latitude:float,
 * 		longitude:float,
 * 		zipcode:string,
 * 		timezone:string
 * 	}
 */
class ImportSubnet extends Command
{
    /**
     * @var string
     */
    protected $signature = 'jeoip:ip2location:import:subnet
		{--ipv=}
		{file}';

    /**
     * @var string
     */
    protected $description = 'Import locations and subnets into database';

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

        $model = 4 == $ipv ? SubnetV4::class : SubnetV6::class;

        $fd = new \SplFileObject($file, 'r');
        while (!$fd->eof()) {
            $row = $fd->fgetcsv();
            if (!$row) {
                continue;
            }

            $row = $this->parseCsv($row);

            if ('-' == $row['countryCode']) {
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
            'countryCode',
            'country',
            'region',
            'city',
            'latitude',
            'longitude',
            'zipcode',
            'timezone',
        ];

        $count = count($data);
        if ($count != count($columns)) {
            throw new Exception('Csv data is not supported');
        }
        $data = array_combine($columns, $data);

        $data['latitude'] = floatval($data['latitude']);
        $data['longitude'] = floatval($data['longitude']);

        /*
         * @var CsvData
         */
        return $data;
    }

    /**
     * @param class-string<SubnetV4|SubnetV6> $model
     * @param CsvData                         $data
     *
     * @return SubnetV4|SubnetV6
     */
    protected function save(string $model, array $data)
    {
        $locationId = $this->saveLocation($data)->id;

        return $model::updateOrCreate(
            ['network_start' => $data['network_start']],
            [
                'network_end' => $data['network_end'],
                'location_id' => $locationId,
                'cidr' => Cidr::fromRange($data['network_start'], $data['network_end']),
            ]
        );
    }

    /**
     * @param CsvData $data
     */
    protected function saveLocation(array $data): Location
    {
        return Location::updateOrCreate(
            [
                'countryCode' => $data['countryCode'],
                'region' => $data['region'],
                'city' => $data['city'],
            ],
            [
                'country' => $data['country'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'zipcode' => $data['zipcode'],
                'timezone' => $data['timezone'],
            ]
        );
    }
}
