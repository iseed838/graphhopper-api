<?php

namespace Graphhopper\Models;

use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;

/**
 * Path response model
 * Class RoutePathResponse
 * @package Graphhopper\Models
 * @property null|float|integer $distance
 * @property null|float|integer $weight
 * @property null|integer $time
 * @property null|integer $transfers
 * @property null|string $snapped_waypoints
 * @property null|array $details
 * @property null|array $legs
 * @property null|array $points
 */
class RoutePathResponse
{
    use ConfigurableTrait, ValidatorTrait;

    protected $distance          = null;
    protected $weight            = null;
    protected $time              = null;
    protected $transfers         = null;
    protected $snapped_waypoints = null;
    protected $details           = null;
    protected $legs              = null;
    protected $points            = null;

    /**
     * @return float|int|null
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @return float|int|null
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return int|null
     */
    public function getTime(): ?int
    {
        return $this->time;
    }

    /**
     * @return int|null
     */
    public function getTransfers(): ?int
    {
        return $this->transfers;
    }

    /**
     * @return null|string
     */
    public function getSnappedWaypoints(): ?string
    {
        return $this->snapped_waypoints;
    }

    /**
     * @return array|null
     */
    public function getDetails(): ?array
    {
        return $this->details;
    }

    /**
     * @return array|null
     */
    public function getLegs(): ?array
    {
        return $this->legs;
    }

    /**
     * @return array|null
     */
    public function getPoints(): ?array
    {
        return $this->points;
    }

}