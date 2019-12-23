<?php

namespace Graphhopper\Models;

use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;
use Graphhopper\Di;


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

    private $info  = null;
    private $paths = null;
    private $hints = null;

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
     * @throws \ReflectionException
     */
    public function getInfo(): RouteInfoResponse
    {
        return Di::get(RouteInfoResponse::class, $this->info);
    }

    /**
     * @return RoutePathResponse[]|array
     * @throws \ReflectionException
     */
    public function getPaths(): array
    {
        $items = [];
        if (!empty($this->paths)) {
            foreach ($this->paths as $path) {
                $items[] = Di::get(RoutePathResponse::class, $path);
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