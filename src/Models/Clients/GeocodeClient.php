<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 08.12.19
 * Time: 23:23
 */

namespace Graphhopper\Models\Clients;


use Graphhopper\Factory;
use Graphhopper\Models\GeocodeQueryRequest;
use Graphhopper\Models\GeocodeReverseRequest;
use Graphhopper\Models\GeocodeResponse;
use Graphhopper\Traits\ConfigurableTrait;
use Graphhopper\Traits\ValidatorTrait;
use GuzzleHttp\Client;

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

    private $key                 = null;
    private $url                 = Factory::DEFAULT_URL;
    private $version             = Factory::DEFAULT_VERSION;
    private $basic_auth_username = null;
    private $basic_auth_password = null;
    private $client              = null;

    /**
     * GeocodeClient constructor.
     * @param Client|null $client
     * @param array $properties
     */
    public function __construct(array $properties = [], Client $client = null)
    {
        if (is_null($this->getClient())) {
            $this->setClient(new Client());
        }
        if (!empty($properties)) {
            $this->configure($properties);
        }
    }

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
     * Get query request
     * @param GeocodeQueryRequest $request
     * @return GeocodeResponse
     * @throws \Graphhopper\Exceptions\ValidException
     * @throws \Rakit\Validation\RuleQuashException
     * @throws \ReflectionException
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
     * @throws \Graphhopper\Exceptions\ValidException
     * @throws \Rakit\Validation\RuleQuashException
     * @throws \ReflectionException
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
     * @return ConfigurableTrait|mixed|null|object
     * @throws \ReflectionException
     */
    private function request(string $query)
    {
        $url = "{$this->url}/{$this->version}/geocode/?{$query}";
        if (!is_null($this->getKey())) {
            $url .= "&key={$this->getKey()}";
        }
        $options = [];
        if (!empty($this->getBasicAuthUsername()) && !empty($this->getBasicAuthPassword())) {
            $options['auth'] = [$this->getBasicAuthUsername(), $this->getBasicAuthPassword()];
        }
        $response = $this->getClient()->request('GET', $url, $options);
        $result   = json_decode($response->getBody()->getContents(), true);
        $model    = new GeocodeResponse($result);

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
     * @return GeocodeClient $this;
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
     * @return GeocodeClient $this;
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
     * @return GeocodeClient $this;
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
     * @return GeocodeClient $this;
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
     * @return GeocodeClient $this;
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
     * @return GeocodeClient $this;
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
     * @return GeocodeClient $this;
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

}