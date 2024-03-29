<?php

namespace Graphhopper\Models\Clients;

use Graphhopper\Exceptions\ValidException;
use Graphhopper\Models\Dictionary;
use Graphhopper\Models\GeocodeQueryRequest;
use Graphhopper\Models\GeocodeReverseRequest;
use Graphhopper\Models\GeocodeResponse;
use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;
use GuzzleHttp\Client;
use Rakit\Validation\RuleQuashException;

/**
 * Class GeocodeClient
 * @package Graphhopper\Models\Clients
 * @property string|null $key
 * @property integer $version
 * @property string $language
 * @property string $url
 * @property string|null $basic_auth_username
 * @property string|null $basic_auth_password
 * @property null|Client $client
 */
class GeocodeClient
{
    use ConfigurableTrait, ValidatorTrait;

    public $key                 = null;
    public $url                 = Dictionary::DEFAULT_URL;
    public $version             = Dictionary::DEFAULT_VERSION;
    public $basic_auth_username = null;
    public $basic_auth_password = null;
    public $client              = null;

    /**
     * GeocodeClient constructor.
     * @param Client $client
     * @param array $properties
     */
    public function __construct(Client $client, array $properties = [])
    {
        $this->client = $client;
        if (!empty($properties)) {
            $this->configure($properties);
        }
    }

    /**
     * @throws ValidException
     * @throws RuleQuashException
     */
    public function check()
    {
        $this->validateOrExcept([
            'key'                 => 'string',
            'version'             => 'integer',
            'url'                 => 'required|url',
            'basic_auth_username' => 'string',
            'basic_auth_password' => 'string',
        ]);
    }

    /**
     * Get query request
     * @param GeocodeQueryRequest $request
     * @return GeocodeResponse
     * @throws ValidException
     * @throws RuleQuashException
     */
    public function query(GeocodeQueryRequest $request): GeocodeResponse
    {
        $this->check();
        $request->check();

        return $this->request($request->getQueryString());
    }

    /**
     *  Get query request
     * @param GeocodeReverseRequest $request
     * @return GeocodeResponse
     * @throws ValidException
     * @throws RuleQuashException
     */
    public function reverse(GeocodeReverseRequest $request): GeocodeResponse
    {
        $this->check();
        $request->check();

        return $this->request($request->getQueryString());
    }

    /**
     * Make request
     * @param string $query
     * @return mixed|null
     */
    private function request(string $query)
    {
        $url = "{$this->url}";
        if ($this->version) {
            $url .= "/{$this->version}";
        }
        $url .= "/{$this->version}/geocode/?{$query}";
        if (!is_null($this->getKey())) {
            $url .= "&key={$this->getKey()}";
        }
        $options = [];
        if (!empty($this->getBasicAuthUsername()) && !empty($this->getBasicAuthPassword())) {
            $options['auth'] = [$this->getBasicAuthUsername(), $this->getBasicAuthPassword()];
        }
        $response = $this->getClient()->request('GET', $url, $options);
        $result   = json_decode($response->getBody()->getContents(), true);

        return new GeocodeResponse($result);
    }

    /**
     * @return null|string
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param null|string $key
     * @return GeocodeClient
     */
    public function setKey(?string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @param int $version
     * @return GeocodeClient
     */
    public function setVersion(int $version): self
    {
        $this->version = $version;

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
     * @return GeocodeClient
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return GeocodeClient
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBasicAuthUsername(): ?string
    {
        return $this->basic_auth_username;
    }

    /**
     * @param null|string $basic_auth_username
     * @return GeocodeClient
     */
    public function setBasicAuthUsername(?string $basic_auth_username): self
    {
        $this->basic_auth_username = $basic_auth_username;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBasicAuthPassword(): ?string
    {
        return $this->basic_auth_password;
    }

    /**
     * @param null|string $basic_auth_password
     * @return GeocodeClient
     */
    public function setBasicAuthPassword(?string $basic_auth_password): self
    {
        $this->basic_auth_password = $basic_auth_password;

        return $this;
    }

    /**
     * @return null|Client
     */
    public function getClient(): ?Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return GeocodeClient
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

}