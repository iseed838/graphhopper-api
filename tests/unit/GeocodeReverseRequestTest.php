<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Factory;
use Graphhopper\Models\GeocodeReverseRequest;

class GeocodeReverseRequestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Graphhopper\Exceptions\ValidException
     * @throws \Rakit\Validation\RuleQuashException
     */
    public function testCreate()
    {
        /** @var GeocodeReverseRequest $model */
        $model = new GeocodeReverseRequest([
            'point'    => '55.6916244,37.7225474',
            'language' => Factory::LANGUAGE_EN,
            'limit'    => 1
        ]);
        $model->check();
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(\Graphhopper\Models\GeocodeReverseRequest::class, $model);
        $this->assertSame($model->getPoint(), '55.6916244,37.7225474');
        $this->assertSame($model->getLanguage(), Factory::LANGUAGE_EN);
        $this->assertSame($model->getLimit(), 1);

    }
}