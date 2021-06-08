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
use Graphhopper\Models\GeocodeQueryRequest;
use PHPUnit\Framework\TestCase;
use Rakit\Validation\RuleQuashException;

class GeocodeQueryRequestTest extends TestCase
{
    /**
     * @throws ValidException
     * @throws RuleQuashException
     */
    public function testCreate()
    {
        $model = new GeocodeQueryRequest([
            'query'    => 'Moscow Valilova 6',
            'language' => Dictionary::LANGUAGE_EN,
            'limit'    => 3
        ]);
        $model->check();
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(GeocodeQueryRequest::class, $model);
        $this->assertSame($model->getQuery(), 'Moscow Valilova 6');
        $this->assertSame($model->getLanguage(), Dictionary::LANGUAGE_EN);
        $this->assertSame($model->getLimit(), 3);

    }
}