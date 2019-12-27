<?php

namespace Graphhopper\Models;

use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;


/**
 * Route response model
 * Class RouteResponse
 * @package Graphhopper\Models
 * @property RouteInfoResponse $info
 * @property RoutePathResponse[] $paths
 * @property array $hints
 */
class RouteResponse
{
    use ConfigurableTrait, ValidatorTrait;

    protected $info  = null;
    protected $paths = null;
    protected $hints = null;

    /**
     * Get first distance
     * @return float|int|null
     */
    public function getFirstDistance()
    {
        if (!isset($this->paths[0])) {
            return null;
        }

        return $this->paths[0]['distance'];
    }

    /**
     * Get first time
     * @return float|int|null
     */
    public function getFirstTime()
    {
        if (!isset($this->paths[0])) {
            return null;
        }

        return $this->paths[0]['time'];
    }

    /**
     * @return RouteInfoResponse
     */
    public function getInfo(): RouteInfoResponse
    {
        return new RouteInfoResponse($this->info);
    }

    /**
     * @return RoutePathResponse[]|array
     */
    public function getPaths(): array
    {
        $items = [];
        if (!empty($this->paths)) {
            foreach ($this->paths as $path) {
                $items[] = new RoutePathResponse($path);
            }
        }

        return $items;
    }


    /**
     * @return array[]
     */
    public function getHints(): array
    {
        return $this->hints;
    }


}