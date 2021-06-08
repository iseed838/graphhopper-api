<?php
/**
 * Created by PhpStorm.
 * User: iseed
 * Date: 22.12.19
 * Time: 13:27
 */

namespace unit;


use Graphhopper\Exceptions\ValidException;
use Graphhopper\Models\Dictionary;
use Graphhopper\Models\GeocodeReverseRequest;
use PHPUnit\Framework\TestCase;
use Rakit\Validation\RuleQuashException;

class GeocodeReverseRequestTest extends TestCase
{
    /**
     * @throws ValidException
     * @throws RuleQuashException
     */
    public function testCreate()
    {
        /** @var GeocodeReverseRequest $model */
        $model = new GeocodeReverseRequest([
            'point'    => '55.6916244,37.7225474',
            'language' => Dictionary::LANGUAGE_EN,
            'limit'    => 1
        ]);
        $model->check();
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(GeocodeReverseRequest::class, $model);
        $this->assertSame($model->getPoint(), '55.6916244,37.7225474');
        $this->assertSame($model->getLanguage(), Dictionary::LANGUAGE_EN);
        $this->assertSame($model->getLimit(), 1);

    }
}