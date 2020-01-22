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
use Graphhopper\Models\RouteRequest;
use PHPUnit\Framework\TestCase;
use Rakit\Validation\RuleQuashException;

class RouteRequestTest extends TestCase
{
    /**
     * @throws ValidException
     * @throws RuleQuashException
     */
    public function testCreate()
    {
        $model = new RouteRequest([
            'points'            => [
                '55.630358,37.516776',
                '55.6916244,37.7225474'
            ],
            'language'          => Dictionary::LANGUAGE_RU,
            'vehicle'           => RouteRequest::VEHICLE_CAR,
            'is_calc_points'    => 'true',
            'is_instructions'   => 'true',
            'is_points_encoded' => 'true',
            'details'           => [RouteRequest::DETAILS_DISTANCE]
        ]);
        $model->check();
        $this->assertNotEmpty($model);
        $this->assertSame($model->getLanguage(), Dictionary::LANGUAGE_RU);
        $this->assertSame($model->getVehicle(), RouteRequest::VEHICLE_CAR);
        $this->assertTrue(in_array(RouteRequest::DETAILS_DISTANCE, $model->getDetails()));
        $this->assertSame($model->getisCalcPoints(), RouteRequest::YES);
        $this->assertSame($model->getIsInstructions(), RouteRequest::YES);
        $this->assertSame($model->getIsPointsEncoded(), RouteRequest::YES);
    }
}