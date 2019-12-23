<?php

namespace Graphhopper\Models;

use Graphhopper\Factory;
use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;


/**
 * Geocode query request
 * Class RouteRequest
 * @package Graphhopper\Models
 * @property null|string $query
 * @property null|string $point
 * @property string $provider
 * @property string $language
 * @property integer $limit
 */
class GeocodeQueryRequest
{
    use ConfigurableTrait, ValidatorTrait;

    const DEFAULT_QUERY_LIMIT = 5;

    private $query    = null;
    private $point    = null;
    private $provider = Factory::PROVIDER_DEFAULT;
    private $language = Factory::LANGUAGE_EN;
    private $limit    = self::DEFAULT_QUERY_LIMIT;

    /**
     * Check query rules
     * @throws \Graphhopper\Exceptions\ValidException
     * @throws \Rakit\Validation\RuleQuashException
     */
    public function check()
    {
        $this->validateOrExcept([
            'query'    => 'required|string',
            'point'    => 'string',
            'provider' => 'required|in:' . implode(",", Factory::getProviderDictionary()),
            'language' => 'required|in:' . implode(",", Factory::getLanguageDictionary()),
            'limit'    => 'required|integer',
        ]);
    }

    /**
     * @return null|string
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * @param null|string $query
     * @return GeocodeQueryRequest $this;
     */
    public function setQuery(?string $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPoint(): ?string
    {
        return $this->point;
    }

    /**
     * @param float|integer $latitude
     * @param float|integer $longitude
     * @return GeocodeQueryRequest $this;
     */
    public function setPoint($latitude, $longitude): self
    {
        $this->point = "{$latitude}, {$longitude}";

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
     * @return GeocodeQueryRequest $this;
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
     * @return GeocodeQueryRequest $this;
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
     * @return GeocodeQueryRequest $this;
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
            'provider' => $this->getProvider(),
            'limit'    => $this->getLimit(),
            'locale'   => $this->getLanguage()
        ];
        if (!empty($this->getQuery())) {
            $items['q'] = $this->getQuery();
        }
        if (!empty($this->getPoint())) {
            $items['point']   = $this->getPoint();
            $items['reverse'] = Factory::QUERY_REVERSE_TRUE;
        }

        return http_build_query($items);
    }

}