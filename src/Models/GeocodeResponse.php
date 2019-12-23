<?php


namespace Graphhopper\Models;

use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;
use Graphhopper\Di;


/**
 * Geocode response
 * Class GeocodeResponse
 * @package common\modules\graphhopper\models
 * @property integer|null $took
 * @property array $copyrights
 * @property GeocodeHitResponse[]|array $hits
 * @property string|null $locale
 */
class GeocodeResponse
{
    use ConfigurableTrait, ValidatorTrait;

    private $took       = null;
    private $copyrights = [];
    private $hits       = [];
    private $locale     = null;

    /**
     * @return int|null
     */
    public function getTook(): ?int
    {
        return $this->took;
    }

    /**
     * @return array
     */
    public function getCopyrights(): array
    {
        return $this->copyrights;
    }

    /**
     * array|GeocodeHitResponse[]
     * @return array
     * @throws \ReflectionException
     */
    public function getHits(): array
    {
        $hits = [];
        if (!empty($this->hits) && is_array($this->hits)) {
            foreach ($this->hits as $hit) {
                $hits[] = Di::get(GeocodeHitResponse::class, $hit);
            }
        }

        return $hits;
    }

    /**
     * @return null|string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

}