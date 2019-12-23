<?php

namespace Graphhopper\Models\Clients;


use Graphhopper\Di;
use Graphhopper\Factory;
use Graphhopper\Models\RouteRequest;
use Graphhopper\Models\RouteResponse;
use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;
use GuzzleHttp\Client;

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

    private $key                 = null;
    private $version             = Factory::DEFAULT_VERSION;
    private $url                 = Factory::DEFAULT_URL;
    private $basic_auth_username = null;
    private $basic_auth_password = null;
    private $client              = null;

    /**
     * @throws \Graphhopper\Exceptions\ValidException
     * @throws \Rakit\Validation\RuleQuashException
     */
    public function check()
    {
        $this->validateOrExcept([
            'key'                 => 'string',
            'version'             => 'required|integer',
            'url'                 => 'required|url',
            'basic_auth_username' => 'string',
            'basic_auth_password' => 'string',
        ]);
    }

    /**
     * @throws \ReflectionException
     */
    public function init()
    {
        if (is_null($this->getClient())) {
            $this->setClient(Di::get(Client::class));
        }
    }

    /**
     * Get patch from point array
     * @param RouteRequest $request
     * @return RouteResponse
     * @throws \Graphhopper\Exceptions\ValidException
     * @throws \Rakit\Validation\RuleQuashException
     * @throws \ReflectionException
     */
    public function paths(RouteRequest $request): RouteResponse
    {
        $this->check();
        $request->check();
        $url = "{$this->url}/{$this->version}/route/?{$request->getQueryString()}";
        if (!is_null($this->getKey())) {
            $url .= "&key={$this->getKey()}";
        }
        $options = [];
        if (!empty($this->getBasicAuthUsername()) && !empty($this->getBasicAuthPassword())) {
            $options['auth'] = [$this->getBasicAuthUsername(), $this->getBasicAuthPassword()];
        }
        $response = $this->getClient()->request('GET', $url, $options);
        $result   = json_decode($response->getBody()->getContents(), true);
        $model    = Di::get(RouteResponse::class, $result);

        return $model;
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
     * @return RouteClient $this;
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
     * @return RouteClient $this;
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
     * @return RouteClient $this;
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
     * @return RouteClient $this;
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
     * @return RouteClient $this;
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
     * @return RouteClient $this;
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

}