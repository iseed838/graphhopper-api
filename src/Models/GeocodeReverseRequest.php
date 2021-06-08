<?php

namespace Graphhopper\Models;


use Graphhopper\Exceptions\ValidException;
use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;
use Rakit\Validation\RuleQuashException;


/**
 * Geocode reverse request
 * Class RouteRequest
 * @package Graphhopper\Models
 * @property null|string $query
 * @property null|string $point
 * @property string $provider
 * @property string $language
 * @property integer $limit
 */
class GeocodeReverseRequest
{
    use ConfigurableTrait, ValidatorTrait;

    const QUERY_REVERSE_TRUE  = 'true';
    const DEFAULT_QUERY_LIMIT = 1;

    protected $point    = null;
    protected $provider = Dictionary::PROVIDER_DEFAULT;
    protected $language = Dictionary::LANGUAGE_EN;
    protected $limit    = self::DEFAULT_QUERY_LIMIT;

    /**
     * Check reverse rules
     * @throws ValidException
     * @throws RuleQuashException
     */
    public function check()
    {
        $this->validateOrExcept([
            'point'    => 'required|string',
            'provider' => 'required|in:' . implode(",", Dictionary::getProviderDictionary()),
            'language' => 'required|in:' . implode(",", Dictionary::getLanguageDictionary()),
            'limit'    => 'required|integer',
        ]);
    }

    /**
     * @return null|string
     */
    public function getPoint(): ?string
    {
        return $this->point;
    }

    /**
     * @param $latitude
     * @param $longitude
     * @return GeocodeReverseRequest
     */
    public function setPoint($latitude, $longitude): self
    {
        $this->point = "{$latitude},{$longitude}";

        return $this;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     * @return GeocodeReverseRequest $this;
     */
    public function setProvider(string $provider): self
    {
        $this->provider = $provider;

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
     * @return GeocodeReverseRequest $this;
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return GeocodeReverseRequest $this;
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Get query string
     * @return string
     */
    public function getQueryString(): string
    {
        $items = [
            'point'    => $this->getPoint(),
            'reverse'  => self::QUERY_REVERSE_TRUE,
            'provider' => $this->getProvider(),
            'limit'    => $this->getLimit(),
            'locale'   => $this->getLanguage()
        ];

        return http_build_query($items);
    }

}