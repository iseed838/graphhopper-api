<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Models\Clients\RouteClient;
use Graphhopper\Models\Dictionary;
use GuzzleHttp\Client;

class RouteClientTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Graphhopper\Exceptions\ValidException
     * @throws \Rakit\Validation\RuleQuashException
     */
    public function testCreate()
    {
        $model = new RouteClient(new Client(), [
            'url'                 => Dictionary::DEFAULT_URL,
            'version'             => Dictionary::DEFAULT_VERSION,
            'key'                 => 'asd-123',
            'basic_auth_username' => 'user',
            'basic_auth_password' => 'password',
        ]);
        $model->check();
        $this->assertNotEmpty($model);
        $this->assertSame($model->getUrl(), Dictionary::DEFAULT_URL);
        $this->assertSame($model->getVersion(), Dictionary::DEFAULT_VERSION);
        $this->assertSame($model->getKey(), 'asd-123');
        $this->assertSame($model->getBasicAuthUsername(), 'user');
        $this->assertSame($model->getBasicAuthPassword(), 'password');
    }
}