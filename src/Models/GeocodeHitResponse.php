<?php

namespace Graphhopper\Models;

use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;

/**
 * Geocoder hits response
 * Class GeocodeHintsResponse
 * @package Graphhopper\Models
 * @property array $point
 * @property null|string $osm_id
 * @property null|string $osm_type
 * @property null|string $osm_value
 * @property null|string $osm_key
 * @property null|string $name
 * @property null|string $country
 * @property null|string $city
 * @property null|string $state
 * @property null|string stateDistrict
 * @property null|string $street
 * @property null|string $housenumber
 * @property null|string $house_number
 * @property null|string $postcode
 * @property array $extent
 */
class GeocodeHitResponse
{
    use ConfigurableTrait, ValidatorTrait;

    const OSM_TYPE_NODE     = 'N';
    const OSM_TYPE_RELATION = 'R';
    const OSM_TYPE_WAY      = 'W';

    private $point         = [];
    private $osm_id        = null;
    private $osm_type      = null;
    private $osm_value     = null;
    private $osm_key       = null;
    private $name          = null;
    private $country       = null;
    private $city          = null;
    private $state         = null;
    private $stateDistrict = null;
    private $street        = null;
    private $housenumber   = null;
    private $house_number  = null;
    private $postcode      = null;
    private $extent        = [];

    /**
     * @return array
     */
    public function getPoint(): array
    {
        return $this->point;
    }

    /**
     * @return null|string
     */
    public function getOsmId(): ?string
    {
        return $this->osm_id;
    }

    /**
     * @return null|string
     */
    public function getOsmType(): ?string
    {
        return $this->osm_type;
    }

    /**
     * @return null|string
     */
    public function getOsmValue(): ?string
    {
        return $this->osm_value;
    }

    /**
     * @return null|string
     */
    public function getOsmKey(): ?string
    {
        return $this->osm_key;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return null|string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @return null|string
     */
    public function getStateDistrict(): ?string
    {
        return $this->stateDistrict;
    }

    /**
     * @return null|string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return null|string
     */
    public function getHousenumber(): ?string
    {
        if (!empty($this->house_number)) {
            return $this->house_number;
        }

        return $this->housenumber;
    }

    /**
     * @return null|string
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * @return array
     */
    public function getExtent(): array
    {
        return $this->extent;
    }

    /**
     * @return null
     */
    public function getCountry()
    {
        return $this->country;
    }

}