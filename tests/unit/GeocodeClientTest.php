<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;

use Graphhopper\Factory;
use Graphhopper\Models\Clients\GeocodeClient;

class GeocodeClientTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Graphhopper\Exceptions\ValidException
     * @throws \Rakit\Validation\RuleQuashException
     */
    public function testCreate()
    {
        $model = new GeocodeClient([
            'url'                 => Factory::DEFAULT_URL,
            'version'             => Factory::DEFAULT_VERSION,
            'key'                 => 'asd-123',
            'basic_auth_username' => 'user',
            'basic_auth_password' => 'password',
        ]);
        $model->check();
        $this->assertNotEmpty($model);
        $this->assertSame($model->getUrl(), Factory::DEFAULT_URL);
        $this->assertSame($model->getVersion(), Factory::DEFAULT_VERSION);
        $this->assertSame($model->getKey(), 'asd-123');
        $this->assertSame($model->getBasicAuthUsername(), 'user');
        $this->assertSame($model->getBasicAuthPassword(), 'password');
    }
}