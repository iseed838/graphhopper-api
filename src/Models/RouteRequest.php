<?php

namespace Graphhopper\Models;

use Graphhopper\Factory;
use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;


/**
 * Route request
 * Class RouteRequest
 * @package Graphhopper\Models
 * @property array $points
 * @property string $vehicle
 * @property string $language
 * @property string $is_calc_points
 * @property array $details
 */
class RouteRequest
{
    use ConfigurableTrait, ValidatorTrait;

    const MIN_POINTS           = 2;
    const MIN_COORDINATE_VALUE = -180;
    const MAX_COORDINATE_VALUE = 180;
    const CALC_POINT           = 'true';
    const NO_CALC_POINT        = 'false';

    private $points         = [];
    private $vehicle        = Factory::VEHICLE_CAR;
    private $language       = Factory::LANGUAGE_EN;
    private $is_calc_points = self::NO_CALC_POINT;
    private $details        = [Factory::DETAILS_DISTANCE];

    /**
     * @throws \Graphhopper\Exceptions\ValidException
     * @throws \Rakit\Validation\RuleQuashException
     */
    public function check()
    {
        $this->validateOrExcept([
            'points'         => [
                'required',
                'array',
                function ($value) {
                    if (empty($value) || !is_array($value) || count($value) < self::MIN_POINTS) {
                        return false;
                    }
                    foreach ($value as $coordinate) {
                        list($latitude, $longitude) = explode(",", $coordinate);
                        if (empty($latitude) ||
                            $latitude < self::MIN_COORDINATE_VALUE ||
                            $latitude > self::MAX_COORDINATE_VALUE) {
                            return false;
                        }
                        if (empty($longitude) ||
                            $longitude < self::MIN_COORDINATE_VALUE ||
                            $longitude > self::MAX_COORDINATE_VALUE) {
                            return false;
                        }
                    }

                    return true;
                }
            ],
            'vehicle'        => 'required|in:' . implode(",", Factory::getVehicleDictionary()),
            'language'       => 'required|in:' . implode(",", Factory::getLanguageDictionary()),
            'is_calc_points' => 'required|in:' . implode(",", [self::CALC_POINT, self::NO_CALC_POINT]),
            'details'        => 'array|in_array:' . implode(",", Factory::getDetailsDictionary()),
        ]);
    }

    /**
     * @return array
     */
    public function getPoints(): array
    {
        return $this->points;
    }

    /**
     * @param array $points
     * @return RouteRequest $this;
     */
    public function setPoints(array $points): self
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return string
     */
    public function getVehicle(): string
    {
        return $this->vehicle;
    }

    /**
     * @param string $vehicle
     * @return RouteRequest $this;
     */
    public function setVehicle(string $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return RouteRequest $this;
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    public function getisCalcPoints(): string
    {
        return $this->is_calc_points;
    }

    /**
     * @param string $is_calc_points
     * @return RouteRequest $this;
     */
    public function setIsCalcPoints(string $is_calc_points): self
    {
        $this->is_calc_points = $is_calc_points;

        return $this;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @param array $details
     * @return RouteRequest $this;
     */
    public function setDetails(array $details): self
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get query string
     * @return string
     */
    public function getQueryString(): string
    {
        $points = [];
        foreach ($this->getPoints() as $point) {
            $points[] = "point={$point}";
        }
        $query = implode("&", $points);
        $items = [
            'vehicle'     => $this->getVehicle(),
            'locale'      => $this->getLanguage(),
            'calc_points' => $this->getIsCalcPoints(),
            'details'     => implode(",", $this->getDetails())
        ];

        return $query . '&' . http_build_query($items);
    }

}