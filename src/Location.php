<?php

namespace Jeoip\Ip2Location;

use Jeoip\Common\Exceptions\Exception;
use Jeoip\Common\Location as CommonLocation;
use Jeoip\Contracts\ICidr;
use Jeoip\Ip2Location\Models\SubnetV4;
use Jeoip\Ip2Location\Models\SubnetV6;

class Location extends CommonLocation
{
    /**
     * @param SubnetV4|SubnetV6 $subnet
     */
    public static function fromSubnet($subnet): self
    {
        $location = $subnet->location;
        if (null === $location) {
            throw new Exception();
        }

        return new self(
            $location->countryCode,
            $subnet->cidr,
            $location->country,
            $location->region,
            $location->city,
            $location->latitude,
            $location->longitude,
            $location->zipcode,
            $location->timezone,
        );
    }

    protected string $country;
    protected string $region;
    protected string $city;
    protected float $latitude;
    protected float $longitude;
    protected string $zipcode;
    protected string $timezone;

    public function __construct(
        string $countryCode,
        ICidr $subnet,
        string $country,
        string $region,
        string $city,
        float $latitude,
        float $longitude,
        string $zipcode,
        string $timezone,
    ) {
        $this->setCountryCode($countryCode);
        $this->setSubnet($subnet);
        $this->setCountry($country);
        $this->setRegion($region);
        $this->setCity($city);
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
        $this->setZipcode($zipcode);
        $this->setTimezone($timezone);
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): void
    {
        $this->zipcode = $zipcode;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }

    /**
     * @return array{countryCode:string,subnet:string,country:string,region:string,city:string,latitude:float,longitude:float,zipcode:string,timezone:string}
     */
    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();
        $data['country'] = $this->country;
        $data['region'] = $this->region;
        $data['city'] = $this->city;
        $data['latitude'] = $this->latitude;
        $data['longitude'] = $this->longitude;
        $data['zipcode'] = $this->zipcode;
        $data['timezone'] = $this->timezone;

        return $data;
    }
}
