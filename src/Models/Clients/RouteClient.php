<?php

namespace Graphhopper\Models\Clients;

use Graphhopper\Exceptions\ValidException;
use Graphhopper\Models\Dictionary;
use Graphhopper\Models\RouteRequest;
use Graphhopper\Models\RouteResponse;
use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\Utils;
use Rakit\Validation\RuleQuashException;

/**
 * Class RouteClient
 * @package Graphhopper\Models\Clients
 * @property string|null $key
 * @property integer $version
 * @property string $language
 * @property string $url
 * @property string|null $basic_auth_username
 * @property string|null $basic_auth_password
 * @property null|Client $client
 */
class RouteClient
{
    use ConfigurableTrait, ValidatorTrait;

    public $key                 = null;
    public $version             = Dictionary::DEFAULT_VERSION;
    public $url                 = Dictionary::DEFAULT_URL;
    public $basic_auth_username = null;
    public $basic_auth_password = null;
    public $client              = null;

    /**
     * RouteClient constructor.
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
     * Get patch from point array
     * @param RouteRequest $request
     * @return RouteResponse
     * @throws RuleQuashException
     * @throws ValidException
     * @throws GuzzleException
     */
    public function paths(RouteRequest $request): RouteResponse
    {
        $this->check();
        $request->check();
        $url = "{$this->url}";
        if ($this->version) {
            $url .= "/{$this->version}";
        }
        $url .= "/route/?{$request->getQueryString()}";
        if (!is_null($this->getKey())) {
            $url .= "&key={$this->getKey()}";
        }
        $options = [];
        if (!empty($this->getBasicAuthUsername()) && !empty($this->getBasicAuthPassword())) {
            $options['auth'] = [$this->getBasicAuthUsername(), $this->getBasicAuthPassword()];
        }
        $response = $this->getClient()->request('GET', $url, $options);
        $result   = json_decode($response->getBody()->getContents(), true);

        return new RouteResponse($result);
    }

    /**
     * Get patches from points using asynchronous loading
     * @param RouteRequest[] $requests
     * @return RouteResponse[]
     * @throws RuleQuashException
     * @throws ValidException
     */
    public function asyncPaths(array $requests): array
    {
        $this->check();
        $options = [];
        if (!empty($this->getBasicAuthUsername()) && !empty($this->getBasicAuthPassword())) {
            $options['auth'] = [$this->getBasicAuthUsername(), $this->getBasicAuthPassword()];
        }
        $baseUrl  = "{$this->url}";
        if ($this->version) {
            $baseUrl .= "/{$this->version}";
        }
        $baseUrl .= "/route/?" . (!is_null($this->getKey()) ? "key={$this->getKey()}&" : '');
        $promises = [];
        foreach ($requests as $key => $request) {
            $request->check();
            $promises[$key] = $this->getClient()->getAsync($baseUrl . $request->getQueryString(), $options);
        }
        $results = Utils::settle($promises)->wait();
        $data    = [];
        foreach ($results as $key => $result) {
            $response = $result['value'];
            if (!is_null($response)) {
                $data[$key] = new RouteResponse(json_decode($response->getBody()->getContents(), true));
            }
        }

        return $data;
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
     * @return RouteClient
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
     * @return RouteClient
     */
    public function setVersion(int $version): self
    {
        $this->version = $version;

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
     * @return RouteClient
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
     * @return RouteClient
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
     * @return RouteClient
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
     * @return RouteClient
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

}
