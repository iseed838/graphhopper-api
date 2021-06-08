<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Exceptions\ValidException;
use Graphhopper\Models\Clients\GeocodeClient;
use Graphhopper\Models\Dictionary;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Rakit\Validation\RuleQuashException;

class GeocodeClientTest extends TestCase
{
    /**
     * @throws ValidException
     * @throws RuleQuashException
     */
    public function testCreate()
    {
        $model = new GeocodeClient(new Client(), [
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