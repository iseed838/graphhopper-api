<?php


namespace Graphhopper\Models;

use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;

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

    protected $took       = null;
    protected $copyrights = [];
    protected $hits       = [];
    protected $locale     = null;

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
     */
    public function getHits(): array
    {
        $hits = [];
        if (!empty($this->hits) && is_array($this->hits)) {
            foreach ($this->hits as $hit) {
                $hits[] = new GeocodeHitResponse($hit);
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