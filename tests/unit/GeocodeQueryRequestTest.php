<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Factory;
use Graphhopper\Models\GeocodeQueryRequest;

class GeocodeQueryRequestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Graphhopper\Exceptions\ValidException
     * @throws \Rakit\Validation\RuleQuashException
     */
    public function testCreate()
    {
        $model = new GeocodeQueryRequest([
            'query'    => 'Moscow Valilova 6',
            'language' => Factory::LANGUAGE_EN,
            'limit'    => 3
        ]);
        $model->check();
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(\Graphhopper\Models\GeocodeQueryRequest::class, $model);
        $this->assertSame($model->getQuery(), 'Moscow Valilova 6');
        $this->assertSame($model->getLanguage(), Factory::LANGUAGE_EN);
        $this->assertSame($model->getLimit(), 3);

    }
}