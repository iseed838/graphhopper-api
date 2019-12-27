<?php


namespace Graphhopper\Models;

use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;


/**
 * Route info response
 * Class RouteInfoResponse
 * @package Graphhopper\Models
 * @property null|array $copyrights
 * @property null|integer $took
 */
class RouteInfoResponse
{
    use ConfigurableTrait, ValidatorTrait;

    protected $copyrights = null;
    protected $took       = null;

    /**
     * @return array|null
     */
    public function getCopyrights(): ?array
    {
        return $this->copyrights;
    }

    /**
     * @return int|null
     */
    public function getTook(): ?int
    {
        return $this->took;
    }


}