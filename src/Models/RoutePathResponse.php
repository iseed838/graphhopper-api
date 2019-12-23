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
 */
class RoutePathResponse
{
    use ConfigurableTrait, ValidatorTrait;

    private $distance          = null;
    private $weight            = null;
    private $time              = null;
    private $transfers         = null;
    private $snapped_waypoints = null;

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
}